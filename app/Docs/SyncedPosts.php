<?php

namespace App\Docs;

use RuntimeException;
use WP_Post;

/**
 * Looks up posts created by `docs:sync`, by the source file stored in their meta.
 */
class SyncedPosts
{
    public const SOURCE = '_docs_source';

    public const HASH = '_docs_hash';

    public function find(string $type, string $file): ?WP_Post
    {
        return (
            get_posts([
                'post_type' => $type,
                'post_status' => 'any',
                'meta_key' => self::SOURCE,
                'meta_value' => $file,
                'numberposts' => 1,
            ])[0] ?? null
        );
    }

    /**
     * Whether a post was built from this exact source (and, for docs, sits in this position).
     */
    public function isCurrent(WP_Post $post, string $hash, ?int $order = null): bool
    {
        return (
            get_post_meta($post->ID, self::HASH, true) === $hash
            && ($order === null || (int) $post->menu_order === $order)
        );
    }

    /**
     * Published docs whose source file is not among `$files`.
     *
     * @param  string[]  $files
     * @return WP_Post[]
     */
    public function orphans(array $files): array
    {
        return array_filter(
            get_posts([
                'post_type' => 'doc',
                'post_status' => 'publish',
                'numberposts' => -1,
                'meta_key' => self::SOURCE,
            ]),
            fn (WP_Post $post): bool => ! in_array(get_post_meta($post->ID, self::SOURCE, true), $files, true),
        );
    }

    public function sourceOf(WP_Post $post): string
    {
        return (string) get_post_meta($post->ID, self::SOURCE, true);
    }

    /**
     * Create or update a synced post. `$post` holds `wp_insert_post()` fields, including the
     * source file and hash as `meta_input`.
     */
    public function save(?WP_Post $existing, array $post): void
    {
        $id = wp_insert_post(wp_slash(['ID' => $existing?->ID ?? 0, 'post_status' => 'publish', ...$post]), true);

        if (is_wp_error($id)) {
            throw new RuntimeException("{$post['meta_input'][self::SOURCE]}: {$id->get_error_message()}");
        }
    }

    public function unpublish(WP_Post $post): void
    {
        wp_update_post(['ID' => $post->ID, 'post_status' => 'draft']);
    }

    /**
     * Refuse to take over a page that `docs:sync` did not create.
     */
    public function assertSlugAvailable(?WP_Post $existing, string $type, string $slug, string $file): void
    {
        if ($existing || $type !== 'page' || ! get_page_by_path($slug)) {
            return;
        }

        throw new RuntimeException(
            "A \"{$slug}\" page already exists that docs:sync did not create; rename it or set its _docs_source meta to {$file}.",
        );
    }

    /**
     * Handle a doc whose source file is gone: report it, or unpublish it with `SyncOption::Prune`.
     */
    public function retire(WP_Post $post, SyncOption ...$options): string
    {
        if (! in_array(SyncOption::Prune, $options, true)) {
            return 'orphaned';
        }

        if (! in_array(SyncOption::DryRun, $options, true)) {
            $this->unpublish($post);
        }

        return 'unpublished';
    }
}
