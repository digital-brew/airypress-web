<?php

namespace App\View\Composers;

use App\Docs\DocsIndex;
use Roots\Acorn\View\Composer;

class Docs extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'components.docs-layout',
        'archive-doc',
        'partials.docs-article',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        $navigation = $this->navigation();
        $current = collect($navigation)->search(fn (array $item): bool => $item['active']);

        return [
            'docsNavigation' => $navigation,
            'docsIndex' => DocsIndex::get(),
            'docsArchiveUrl' => get_post_type_archive_link('doc'),
            'previousDoc' => $current !== false ? $navigation[$current - 1] ?? null : null,
            'nextDoc' => $current !== false ? $navigation[$current + 1] ?? null : null,
        ];
    }

    /**
     * Docs in order, followed by the Changelog page when it exists.
     *
     * @return array<int, array{title: string, url: string, active: bool}>
     */
    protected function navigation(): array
    {
        $current = get_queried_object_id();
        $items = get_posts([
            'post_type' => 'doc',
            'post_status' => 'publish',
            'numberposts' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ]);

        if ($changelog = get_page_by_path('changelog')) {
            $items[] = $changelog;
        }

        return array_map(fn ($post): array => [
            'title' => get_the_title($post),
            'url' => get_permalink($post),
            'active' => $post->ID === $current,
        ], $items);
    }
}
