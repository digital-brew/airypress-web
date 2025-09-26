<?php

namespace App\Blocks\Core;

use Masterminds\HTML5;

class Button
{
    public function render(string $blockContent, array $block): string
    {
        if ($block['blockName'] !== 'core/button') {
            return $blockContent;
        }

        $html5 = new HTML5();
        $dom = $html5->loadHTML($blockContent);
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
}
