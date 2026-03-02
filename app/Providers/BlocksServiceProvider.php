<?php

namespace App\Providers;

use App\Blocks\Core\Button;
use App\Blocks\Modal;
use App\Blocks\LatestSeeds;
use Illuminate\Support\ServiceProvider;

class BlocksServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Render `core/button` block with Blade template
         */
        add_filter('render_block', [new Button(), 'render'], 10, 2);

        /**
         * Register and render `radicle/modal` and `radicle/latest-seeds` blocks
         */
        add_action('init', function () {
            register_block_type('radicle/modal', [
                'api_version' => 3,
                'attributes' => [
                    'heading' => [
                        'type' => 'string',
                        'default' => 'Modal heading',
                    ],
                    'buttonText' => [
                        'type' => 'string',
                        'default' => 'Open modal',
                    ],
                ],
                'render_callback' => [new Modal(), 'render'],
            ]);

            register_block_type('radicle/latest-seeds', [
                'api_version' => 3,
                'attributes' => [
                    'posts' => [
                        'type' => 'number',
                        'default' => 5,
                    ],
                    'displayPostContent' => [
                        'type' => 'string',
                        'default' => 'none',
                    ],
                    'postLayout' => [
                        'type' => 'string',
                        'default' => 'list',
                    ],
                    'displayFeaturedImage' => [
                        'type' => 'boolean',
                        'default' => false,
                    ],
                ],
                'render_callback' => [new LatestSeeds(), 'render'],
            ]);
        });
    }
}
