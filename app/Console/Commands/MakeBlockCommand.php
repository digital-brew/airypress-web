<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeBlockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:block {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new block';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        if (! $name) {
            $name = $this->ask('What is the name of the block?');
        }
        $this->info("Creating block {$name}...");

        $studlyName = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
        $kebabName = strtolower(preg_replace('/(?<!^)[A-Z]/', '-\0', $studlyName));

        $this->createBlockClass($studlyName, $kebabName);
        $this->createBlockView($kebabName);
        $this->createBlockJs($studlyName, $kebabName);
        $this->updateEditorJs($studlyName, $kebabName);
        $this->updateBlocksServiceProvider($studlyName, $kebabName);

        $this->info("Block {$name} created successfully.");

        return 0;
    }

    protected function createBlockClass($studlyName, $kebabName)
    {
        $path = app_path("Blocks/{$studlyName}.php");

        if (file_exists($path)) {
            $this->error("Block class already exists: {$path}");
            return;
        }

        // @mago-format-ignore-next
        $content = <<<'EOT'
<?php

namespace App\Blocks;

class {$studlyName}
{
    public function render(string $blockContent, array $block): string
    {
        return view('blocks.{$kebabName}', [
            'block' => $block,
            'blockContent' => $blockContent,
        ]);
    }
}

EOT;

        $content = str_replace(['{$studlyName}', '{$kebabName}'], [$studlyName, $kebabName], $content);

        file_put_contents($path, $content);
    }

    protected function createBlockView($kebabName)
    {
        $path = resource_path("views/blocks/{$kebabName}.blade.php");

        if (file_exists($path)) {
            $this->error("Block view already exists: {$path}");
            return;
        }

        // @mago-format-ignore-next
        $content = <<<'EOT'
<div>
    <!-- Block: {$kebabName} -->
</div>
EOT;

        $content = str_replace('{$kebabName}', $kebabName, $content);

        file_put_contents($path, $content);
    }

    protected function createBlockJs($studlyName, $kebabName)
    {
        $path = resource_path("js/editor/{$kebabName}.block.jsx");

        if (file_exists($path)) {
            $this->error("Block JS already exists: {$path}");
            return;
        }

        // @mago-format-ignore-next
        $content = <<<'EOT'
import { InnerBlocks, useBlockProps } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";

/* Block name */
export const name = `radicle/{$kebabName}`;

/* Block title */
export const title = __(`{$studlyName}`, `radicle`);

/* Block category */
export const category = `design`;

/* Block attributes */
export const attributes = {};

/* Block edit */
export const edit = () => {
  const props = useBlockProps();

  return (
    <div {...props}>
      <InnerBlocks />
    </div>
  );
};

/* Block save */
export const save = () => <InnerBlocks.Content />;

EOT;

        $content = str_replace(['{$studlyName}', '{$kebabName}'], [$studlyName, $kebabName], $content);

        file_put_contents($path, $content);
    }

    protected function updateEditorJs($studlyName, $kebabName)
    {
        $path = resource_path('js/editor.js');
        $content = file_get_contents($path);

        $camelName = lcfirst($studlyName);

        // Add import statement after the last existing import
        $import = "import * as {$camelName}Block from \"./editor/{$kebabName}.block\";";
        $content = preg_replace('/(import \* as \w+Block from "[^"]+";)\n/', "$1\n{$import}\n", $content, 1);

        // Add block to the blocks array
        $content = preg_replace('/(const blocks = \[)([^\]]*)\]/', '$1$2, ' . $camelName . 'Block]', $content, 1);

        file_put_contents($path, $content);
    }

    protected function updateBlocksServiceProvider($studlyName, $kebabName)
    {
        $path = app_path('Providers/BlocksServiceProvider.php');
        $content = file_get_contents($path);

        if ($content === false) {
            $this->error('Could not read BlocksServiceProvider.php');
            return;
        }

        // 1) Ensure use statement exists
        $useStatement = "use App\\Blocks\\{$studlyName};";
        if (! str_contains($content, $useStatement)) {
            // Insert after the last existing "use ..." statement, or after the namespace line
            $content = preg_replace(
                '/^(namespace\s+[^;]+;\s*(?:\Ruse\s+[^;]+;\s*)*)/m',
                '$0' . $useStatement . PHP_EOL,
                $content,
                1,
            );
        }

        // @mago-format-ignore-next
        $registration =
            "\n            register_block_type('radicle/{$kebabName}', [\n"
            . "                'api_version' => 3,\n"
            . "                'attributes' => [],\n"
            . "                'render_callback' => [new {$studlyName}(), 'render'],\n"
            . "            ]);";

        // Skip if it's already present
        if (str_contains($content, "radicle/{$kebabName}")) {
            $this->info('BlocksServiceProvider already contains this block.');
            return;
        }

        // Insert before the closing of the add_action('init', ...) closure
        $pattern = '/(add_action\s*\(\s*[\'"]init[\'"]\s*,\s*function\s*\(\s*\)\s*\{)(.*?)(\n\s*\}\))/s';
        if (! preg_match($pattern, $content)) {
            $this->error('Could not find add_action(\'init\', ...) in BlocksServiceProvider.php');
            return;
        }

        $content = preg_replace($pattern, '$1$2' . $registration . '$3', $content, 1);

        if (file_put_contents($path, $content) === false) {
            $this->error('Failed to write BlocksServiceProvider.php');
            return;
        }

        $this->info('BlocksServiceProvider updated.');
    }
}
