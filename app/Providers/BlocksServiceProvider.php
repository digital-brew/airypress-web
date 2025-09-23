<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Masterminds\HTML5;

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
        add_filter('render_block', function ($block_content, $block) {
            if ($block['blockName'] === 'core/button') {
                $html5 = new HTML5();
                $dom = $html5->loadHTML($block_content);
                $classes = $dom->getElementsByTagName('a')->item(0)->getAttribute('class');
                $classes .= ' ' . ($block['attrs']['className'] ?? '');

                $href = $dom->getElementsByTagName('a')->item(0)->getAttribute('href');

                $div = $dom->getElementsByTagName('div')->item(0);
                $id = null;
                if ($div) {
                    $id = $div->getAttribute('id');
                }

                $rel = $dom->getElementsByTagName('a')->item(0)->getAttribute('rel');
                $text = $dom->getElementsByTagName('a')->item(0)->textContent;
                $variant = 'primary';

                if (
                    isset($block['attrs']['className']) &&
                    strpos($block['attrs']['className'], 'is-style-outline') !== false
                ) {
                    $variant = 'outline';
                }

                return view('blocks.button', [
                    'variant' => $variant,
                    'classes' => $classes,
                    'href' => $href ?? null,
                    'id' => $id ?? null,
                    'rel' => $rel ?? null,
                    'text' => $text ?? null,
                ]);
            }
            return $block_content;
        }, 10, 2);

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
    }
}
