<?php

namespace App\Docs;

use Closure;
use DOMDocument;
use DOMElement;
use League\CommonMark\GithubFlavoredMarkdownConverter;

/**
 * Converts a Markdown document into core block markup.
 *
 * The first `# Heading` becomes the title, the first paragraph the excerpt, and the rest
 * is emitted as core blocks (see BlockMarkup) so it edits and renders like any other content.
 * Relative `*.md` links go through `$resolveLink`; links whose text is just the file name
 * ("appearance.md") get the target's title instead.
 */
class MarkdownToBlocks
{
    /**
     * Bump when the generated markup changes, so `docs:sync` rewrites unchanged sources.
     */
    public const VERSION = 2;

    protected GithubFlavoredMarkdownConverter $markdown;

    protected BlockMarkup $blocks;

    /**
     * @param  Closure(string $file, string $fragment): ?array{url: string, title: string}  $resolveLink
     */
    public function __construct(
        protected Closure $resolveLink,
    ) {
        $this->markdown = new GithubFlavoredMarkdownConverter([
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
        ]);
        $this->blocks = new BlockMarkup();
    }

    /**
     * @return array{title: string, excerpt: string, content: string}
     */
    public function convert(string $markdown): array
    {
        $document = new DOMDocument();
        libxml_use_internal_errors(true);
        $document->loadHTML(
            '<?xml encoding="utf-8"?><body>' . $this->markdown->convert($markdown) . '</body>',
            LIBXML_HTML_NODEFDTD,
        );
        libxml_clear_errors();

        $this->rewriteLinks($document);

        $elements = array_filter(
            iterator_to_array($document->getElementsByTagName('body')->item(0)->childNodes),
            fn ($node): bool => $node instanceof DOMElement,
        );

        $title = $this->first($elements, 'h1');
        $paragraph = $this->first($elements, 'p');

        return [
            'title' => $title ? trim($title->textContent) : '',
            'excerpt' => $paragraph ? trim(preg_replace('/\s+/', ' ', $paragraph->textContent)) : '',
            'content' => implode("\n\n", array_map(
                $this->blocks->block(...),
                array_filter($elements, fn (DOMElement $element): bool => $element !== $title),
            )),
        ];
    }

    /**
     * @param  DOMElement[]  $elements
     */
    protected function first(array $elements, string $tag): ?DOMElement
    {
        foreach ($elements as $element) {
            if ($element->tagName === $tag) {
                return $element;
            }
        }

        return null;
    }

    /**
     * Point relative `*.md` links at their pages; leave other links untouched.
     */
    protected function rewriteLinks(DOMDocument $document): void
    {
        foreach (iterator_to_array($document->getElementsByTagName('a')) as $link) {
            $href = $link->getAttribute('href');

            if (! preg_match('~^(?![a-z][a-z0-9+.-]*:|//|#)(?:[^#]*/)?([^/#]+\.md)(#.*)?$~i', $href, $match)) {
                continue;
            }

            $target = ($this->resolveLink)($match[1], ltrim($match[2] ?? '', '#'));

            if ($target === null) {
                continue;
            }

            $link->setAttribute('href', $target['url']);

            if ($target['title'] !== '' && preg_match('~^[\w./-]+\.md$~i', trim($link->textContent))) {
                $link->textContent = $target['title'];
            }
        }
    }
}
