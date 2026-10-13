<?php

namespace App\Docs;

use DOMElement;
use DOMNode;
use DOMXPath;
use Illuminate\Support\Str;

/**
 * Serializes HTML elements (from rendered Markdown) as core block markup that the
 * block editor validates: headings, paragraphs, lists, tables, code, quotes, separators.
 * Anything else becomes an HTML block.
 */
class BlockMarkup
{
    public function block(DOMElement $node): string
    {
        return match ($node->tagName) {
            'h2', 'h3', 'h4', 'h5', 'h6' => $this->heading($node),
            'p' => $this->wrap('paragraph', [], '<p>' . $this->inner($node) . '</p>'),
            'ul', 'ol' => $this->list($node),
            'table' => $this->table($node),
            'pre' => $this->code($node),
            'blockquote' => $this->quote($node),
            'hr' => $this->wrap('separator', [], '<hr class="wp-block-separator has-alpha-channel-opacity"/>'),
            default => $this->wrap('html', [], $this->outer($node)),
        };
    }

    /**
     * Headings get an `id` from their text, so `page.md#section` links land on them.
     */
    protected function heading(DOMElement $node): string
    {
        $level = (int) substr($node->tagName, 1);

        return $this->wrap(
            'heading',
            $level === 2 ? [] : ['level' => $level],
            sprintf(
                '<h%1$d class="wp-block-heading" id="%2$s">%3$s</h%1$d>',
                $level,
                esc_attr(Str::slug($node->textContent)),
                $this->inner($node),
            ),
        );
    }

    protected function list(DOMElement $node): string
    {
        $items = '';

        foreach ($this->children($node, ['li']) as $item) {
            $nested = implode('', array_map($this->list(...), $this->children($item, ['ul', 'ol'])));
            $items .= $this->wrap('list-item', [], '<li>' . $this->listItemText($item) . $nested . '</li>');
        }

        return $this->wrap(
            'list',
            $node->tagName === 'ol' ? ['ordered' => true] : [],
            sprintf('<%1$s class="wp-block-list">%2$s</%1$s>', $node->tagName, $items),
        );
    }

    /**
     * A list item's own text, without nested lists. List items hold inline content only,
     * so the paragraphs of a loose list item are joined with line breaks.
     */
    protected function listItemText(DOMElement $item): string
    {
        $paragraphs = $this->children($item, ['p']);

        if ($paragraphs !== []) {
            return implode('<br>', array_map($this->inner(...), $paragraphs));
        }

        $inline = array_filter(
            iterator_to_array($item->childNodes),
            fn (DOMNode $child): bool => ! (
                $child instanceof DOMElement
                && in_array($child->tagName, ['ul', 'ol'], true)
            ),
        );

        return trim(implode('', array_map($this->outer(...), $inline)));
    }

    protected function table(DOMElement $node): string
    {
        $sections = '';

        foreach (['thead', 'tbody'] as $section) {
            $rows = '';

            foreach (new DOMXPath($node->ownerDocument)->query("./{$section}/tr", $node) as $row) {
                $cells = '';
                foreach ($this->children($row, ['th', 'td']) as $cell) {
                    $cells .= "<{$cell->tagName}>" . $this->inner($cell) . "</{$cell->tagName}>";
                }
                $rows .= "<tr>{$cells}</tr>";
            }

            $sections .= $rows === '' ? '' : "<{$section}>{$rows}</{$section}>";
        }

        return $this->wrap(
            'table',
            ['hasFixedLayout' => false],
            "<figure class=\"wp-block-table\"><table>{$sections}</table></figure>",
        );
    }

    protected function code(DOMElement $node): string
    {
        $code = $node->getElementsByTagName('code')->item(0) ?? $node;

        return $this->wrap(
            'code',
            [],
            '<pre class="wp-block-code"><code>' . esc_html(rtrim($code->textContent, "\n")) . '</code></pre>',
        );
    }

    protected function quote(DOMElement $node): string
    {
        $inner = implode('', array_map($this->block(...), $this->children($node)));

        return $this->wrap('quote', [], '<blockquote class="wp-block-quote">' . $inner . '</blockquote>');
    }

    /**
     * Child elements, optionally limited to some tag names.
     *
     * @return DOMElement[]
     */
    protected function children(DOMNode $node, array $tags = []): array
    {
        return array_values(array_filter(
            iterator_to_array($node->childNodes),
            fn (DOMNode $child): bool => (
                $child instanceof DOMElement
                && ($tags === [] || in_array($child->tagName, $tags, true))
            ),
        ));
    }

    protected function wrap(string $name, array $attributes, string $html): string
    {
        $json = $attributes ? ' ' . wp_json_encode($attributes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : '';

        return "<!-- wp:{$name}{$json} -->\n{$html}\n<!-- /wp:{$name} -->";
    }

    public function inner(DOMNode $node): string
    {
        return trim(implode('', array_map($this->outer(...), iterator_to_array($node->childNodes))));
    }

    protected function outer(DOMNode $node): string
    {
        return (string) $node->ownerDocument->saveHTML($node);
    }
}
