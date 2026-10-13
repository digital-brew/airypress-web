<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

/**
 * The site never publishes authors: no author archives, names, usernames or profile links
 * in pages, REST, oEmbed, feeds, sitemaps or structured data. Logged-in users keep full
 * access so the editor's author tools still work.
 */
class AuthorsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Author archives (and `?author=1` username lookups) go to the home page.
         */
        add_action('template_redirect', function (): void {
            if (is_author()) {
                wp_safe_redirect(home_url('/'), 301);
                exit();
            }
        });

        /**
         * Hide the users REST endpoints from visitors.
         */
        add_filter('rest_endpoints', function (array $endpoints): array {
            if (is_user_logged_in()) {
                return $endpoints;
            }

            return Arr::where(
                $endpoints,
                fn ($handlers, string $route): bool => ! str_starts_with($route, '/wp/v2/users'),
            );
        });

        /**
         * oEmbed responses carry the author name and archive URL.
         */
        add_filter('oembed_response_data', fn (array $data): array => Arr::except($data, [
            'author_name',
            'author_url',
        ]));

        /**
         * No author sitemap in WordPress core (Rank Math drops its own while author archives are disabled).
         */
        add_filter(
            'wp_sitemaps_add_provider',
            fn ($provider, string $name) => $name === 'users' ? false : $provider,
            10,
            2,
        );

        /**
         * Feeds credit the site, not a person.
         */
        add_filter('the_author', fn ($author) => is_feed() ? get_bloginfo('name') : $author);

        /**
         * Rank Math: drop Person entities and author references from the schema graph,
         * and the "Written by" / "Time to read" Slack sharing labels.
         */
        add_filter(
            'rank_math/json_ld',
            function (array $data): array {
                return collect($data)
                    ->reject(fn ($entity) => is_array($entity) && ($entity['@type'] ?? null) === 'Person')
                    ->map(fn ($entity) => is_array($entity) ? Arr::except($entity, ['author']) : $entity)
                    ->all();
            },
            99,
        );
        add_filter('rank_math/opengraph/slack_enhanced_data', fn (): array => []);
    }
}
