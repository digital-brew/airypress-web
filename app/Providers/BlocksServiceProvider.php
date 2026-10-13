<?php

namespace App\Providers;

use App\Blocks\Core\Button;
use App\Blocks\Modal;
use App\Blocks\Section;
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
        add_filter('render_block_core/button', [new Button(), 'render'], 10, 2);

        /**
         * Group the landing page section blocks under their own inserter category
         */
        add_filter('block_categories_all', fn (array $categories): array => [
            ['slug' => 'airypress', 'title' => __('AiryPress', 'radicle')],
            ...$categories,
        ]);

        /**
         * Register and render the `radicle/modal` block
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

            /**
             * Register the `airypress/*` landing page sections from their block.json files
             */
            foreach (glob(resource_path('js/editor/blocks/*/block.json')) as $metadata) {
                register_block_type(dirname($metadata), [
                    'render_callback' => [new Section(), 'render'],
                ]);
            }

            /**
             * One-click pattern with every section and the launch copy
             */
            register_block_pattern_category('airypress', ['label' => __('AiryPress', 'radicle')]);

            register_block_pattern('airypress/landing', [
                'title' => __('AiryPress landing page', 'radicle'),
                'categories' => ['airypress'],
                'blockTypes' => ['core/post-content'],
                'content' => serialize_blocks(
                    collect(require resource_path('patterns/landing.php'))
                        ->map(fn (array $attributes, string $slug): array => [
                            'blockName' => "airypress/{$slug}",
                            'attrs' => $attributes,
                            'innerBlocks' => [],
                            'innerHTML' => '',
                            'innerContent' => [],
                        ])
                        ->values()
                        ->all(),
                ),
            ]);
        });
    }
}
