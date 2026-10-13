<?php

namespace App\Docs;

use Illuminate\Support\Str;
use RuntimeException;

/**
 * The Markdown docs on disk: which files exist, their order, titles, and where links to them point.
 */
class DocsSource
{
    /** @var array<string, string>|null slug => file name, in docs order */
    protected ?array $docs = null;

    /** @var array<string, string> path => title */
    protected array $titles = [];

    public function __construct(
        public readonly string $path,
        public readonly string $index,
        protected ?string $changelog,
    ) {}

    public function assertReadable(): void
    {
        if (! is_dir($this->path)) {
            throw new RuntimeException("Docs folder not found: {$this->path}");
        }
    }

    /**
     * Docs in the order the index links to them, then any others alphabetically.
     *
     * @return array<string, string> slug => file name
     */
    public function docs(): array
    {
        if ($this->docs !== null) {
            return $this->docs;
        }

        $files = collect(glob("{$this->path}/*.md"))
            ->map(fn (string $file): string => basename($file))
            ->reject(fn (string $file): bool => strcasecmp($file, $this->index) === 0)
            ->sort()
            ->values();

        preg_match_all('/\]\(([^)#\s]+\.md)/i', $this->read($this->indexPath()), $links);

        return $this->docs = collect($links[1])
            ->map(fn (string $link): string => basename($link))
            ->intersect($files)
            ->merge($files)
            ->unique()
            ->mapWithKeys(fn (string $file): array => [Str::slug(Str::beforeLast($file, '.')) => $file])
            ->all();
    }

    public function pathOf(string $file): string
    {
        return "{$this->path}/{$file}";
    }

    public function indexPath(): string
    {
        return $this->pathOf($this->index);
    }

    public function changelogPath(): ?string
    {
        return $this->changelog && is_file($this->changelog) ? $this->changelog : null;
    }

    public function read(string $path): string
    {
        return is_file($path) ? (string) file_get_contents($path) : '';
    }

    /**
     * A Markdown file's first `# Heading`.
     */
    public function title(string $path): string
    {
        if (! array_key_exists($path, $this->titles)) {
            preg_match('/^#\s+(.+?)\s*#*\s*$/m', $this->read($path), $match);
            $this->titles[$path] = $match[1] ?? '';
        }

        return $this->titles[$path];
    }

    /**
     * Where a relative `*.md` link points on the site, and the title of what it points to.
     *
     * @return array{url: string, title: string}|null
     */
    public function resolveLink(string $file, string $fragment): ?array
    {
        $hash = $fragment !== '' ? "#{$fragment}" : '';
        $archive = get_post_type_archive_link('doc');

        if (strcasecmp($file, $this->index) === 0) {
            return ['url' => $archive . $hash, 'title' => __('Documentation', 'radicle')];
        }

        $changelog = $this->changelogPath();
        if ($changelog && strcasecmp($file, basename($changelog)) === 0) {
            return ['url' => home_url('/changelog/') . $hash, 'title' => $this->title($changelog)];
        }

        $slug = array_search($file, $this->docs(), true);

        return (
            $slug === false
                ? null
                : [
                    'url' => trailingslashit($archive . $slug) . $hash,
                    'title' => $this->title($this->pathOf($file)),
                ]
        );
    }
}
