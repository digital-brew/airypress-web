<?php

namespace App\Console\Commands;

use App\Docs\DocsSource;
use App\Docs\DocsSync;
use App\Docs\SyncOption;
use Illuminate\Console\Command;
use RuntimeException;

class DocsSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:sync
        {--source= : Folder with the Markdown docs (default: config docs.path)}
        {--changelog= : CHANGELOG.md to publish as the Changelog page (default: config docs.changelog)}
        {--force : Rewrite every doc, even when its source is unchanged}
        {--prune : Unpublish docs whose source file was removed}
        {--dry-run : Report what would change without writing anything}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync the Markdown docs into the Docs post type and the Changelog page';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sync = new DocsSync(
            new DocsSource(
                rtrim($this->option('source') ?: config('docs.path'), '/'),
                config('docs.index'),
                $this->option('changelog') ?: config('docs.changelog'),
            ),
        );
        $options = array_filter([
            $this->option('force') ? SyncOption::Force : null,
            $this->option('prune') ? SyncOption::Prune : null,
            $this->option('dry-run') ? SyncOption::DryRun : null,
        ]);

        $styles = [
            'created' => 'info',
            'updated' => 'info',
            'unpublished' => 'comment',
            'orphaned' => 'comment',
            'skipped' => 'comment',
        ];

        try {
            $counts = $sync->run(fn (string $status, string $label) => $this->line(sprintf(
                '  <%1$s>%2$-11s</%1$s> %3$s',
                $styles[$status] ?? 'fg=gray',
                $status,
                $label,
            )), ...$options);
        } catch (RuntimeException $exception) {
            $this->error($exception->getMessage());

            return self::FAILURE;
        }

        $summary = collect($counts)->map(fn (int $count, string $status): string => "{$count} {$status}")->implode(
            ', ',
        );
        $this->info(($this->option('dry-run') ? 'Dry run: ' : 'Done: ') . $summary);

        if (array_key_exists('orphaned', $counts)) {
            $this->comment('Some docs have no source file any more; run with --prune to unpublish them.');
        }

        return self::SUCCESS;
    }
}
