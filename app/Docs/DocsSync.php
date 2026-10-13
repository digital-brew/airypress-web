<?php

namespace App\Docs;

use Illuminate\Support\Str;

/**
 * Syncs Markdown docs into the `doc` post type, the docs index and the Changelog page.
 *
 * Posts are matched by their source file and skipped while the source is unchanged,
 * so running it repeatedly is safe.
 */
class DocsSync
{
    public const CHANGELOG_TEMPLATE = 'template-docs.blade.php';

    protected MarkdownToBlocks $converter;

    protected SyncedPosts $posts;

    /** @var SyncOption[] */
    protected array $options = [];

    public function __construct(
        protected DocsSource $source,
    ) {
        $this->converter = new MarkdownToBlocks($source->resolveLink(...));
        $this->posts = new SyncedPosts();
    }

    /**
     * @param  callable(string $status, string $label): void  $report
     * @return array<string, int> counts per status
     */
    public function run(callable $report, SyncOption ...$options): array
    {
        $this->options = $options;
        $this->source->assertReadable();

        $counts = [];
        $tally = function (string $status, string $label) use (&$counts, $report): void {
            $counts[$status] = ($counts[$status] ?? 0) + 1;
            $report($status, $label);
        };

        $order = 0;
        foreach ($this->source->docs() as $slug => $file) {
            $tally($this->upsert('doc', $this->source->pathOf($file), [
                'post_name' => $slug,
                'menu_order' => ++$order,
            ]), $file);
        }

        $tally(
            DocsIndex::sync(
                $this->source->read($this->source->indexPath()),
                $this->converter->convert(...),
                $this->hash(...),
                ...$this->options,
            ),
            $this->source->index,
        );

        if ($changelog = $this->source->changelogPath()) {
            $tally($this->upsert('page', $changelog, [
                'post_name' => 'changelog',
                'page_template' => self::CHANGELOG_TEMPLATE,
            ]), basename($changelog));
        }

        foreach ($this->posts->orphans($this->source->docs()) as $post) {
            $tally(
                $this->posts->retire($post, ...$this->options),
                "{$this->posts->sourceOf($post)} (doc #{$post->ID})",
            );
        }

        return $counts;
    }

    /**
     * Create or update the post built from a Markdown file.
     */
    protected function upsert(string $type, string $path, array $fields): string
    {
        $file = basename($path);
        $markdown = $this->source->read($path);
        $hash = $this->hash($markdown);
        $existing = $this->posts->find($type, $file);

        if (
            $existing
            && ! $this->has(SyncOption::Force)
            && $this->posts->isCurrent($existing, $hash, $fields['menu_order'] ?? null)
        ) {
            return 'unchanged';
        }

        $this->posts->assertSlugAvailable($existing, $type, $fields['post_name'], $file);

        if (! $this->has(SyncOption::DryRun)) {
            $converted = $this->converter->convert($markdown);
            $this->posts->save($existing, [
                'post_type' => $type,
                'post_title' => $converted['title'] ?: Str::headline($fields['post_name']),
                'post_excerpt' => $converted['excerpt'],
                'post_content' => $converted['content'],
                'meta_input' => [SyncedPosts::SOURCE => $file, SyncedPosts::HASH => $hash],
                ...$fields,
            ]);
        }

        return $existing ? 'updated' : 'created';
    }

    protected function hash(string $markdown): string
    {
        return sha1(MarkdownToBlocks::VERSION . '|' . $markdown);
    }

    protected function has(SyncOption $option): bool
    {
        return in_array($option, $this->options, true);
    }
}
