<?php

namespace App\Providers;

use App\Blocks\Core\Button;
use App\Blocks\Modal;
use Illuminate\Support\ServiceProvider;

class BlocksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Render `core/button` block with Blade template
         */
        add_filter('render_block', [new Button(), 'render'], 10, 2);

        /**
         * Render `radicle/modal` block with Blade template
         */
        add_filter('render_block', function ($block_content, $block) {
            if ($block['blockName'] === 'radicle/modal') {
                return view('blocks.modal', [
                    'block' => $block,
                    'blockContent' => $block_content,
                    'buttonText' => $block['attrs']['buttonText'] ?? null,
                    'heading' => $block['attrs']['heading'] ?? null,
                ]);
            }
            return $block_content;
        }, 10, 2);

        /**
         * Render `radicle/latest-seeds` block with Blade template
         */
        add_filter('render_block', function ($block_content, $block) {
            if ($block['blockName'] === 'radicle/latest-seeds') {
                $attributes = $block['attrs'] ?? [];
                $posts = $attributes['posts'] ?? 5;
                $displayPostContent = $attributes['displayPostContent'] ?? 'none';
                $postLayout = $attributes['postLayout'] ?? 'list';
                $displayFeaturedImage = $attributes['displayFeaturedImage'] ?? false;

                $query_args = [
                    'post_type' => 'seed',
                    'numberposts' => $posts,
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'orderby' => 'date',
                ];

                $seeds = get_posts($query_args);

                return view('blocks.latest-seeds', [
                    'seeds' => $seeds,
                    'posts' => $posts,
                    'displayPostContent' => $displayPostContent,
                    'postLayout' => $postLayout,
                    'displayFeaturedImage' => $displayFeaturedImage,
                ]);
            }
            return $block_content;
        }, 10, 2);
        add_filter('render_block', [new Modal(), 'render'], 10, 2);
    }
}
