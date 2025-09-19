# Block Editor (Gutenberg) Development Guide

This guide covers developing custom blocks and working with the WordPress Block Editor in Radicle projects.

## Block Development Overview

Radicle uses server-side rendering for blocks with Blade templates. See `app/Providers/BlocksServiceProvider.php` for registration patterns.

## Creating a Simple Block

### 1. JavaScript Block Definition

Create in `resources/js/editor/my-block.block.jsx`:

```javascript
import { InspectorControls, useBlockProps } from "@wordpress/block-editor";
import { PanelBody, TextControl } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

export const name = `radicle/my-block`;
export const title = __(`My Block`, `radicle`);
export const category = `design`;

export const attributes = {
  title: {
    type: `string`,
    default: __(`Block Title`, `radicle`),
  },
};

export const edit = ({ attributes, setAttributes }) => {
  return (
    <>
      <InspectorControls>
        <PanelBody title={__(`Settings`, `radicle`)}>
          <TextControl
            label={__(`Title`, `radicle`)}
            value={attributes.title}
            onChange={(title) => setAttributes({ title })}
          />
        </PanelBody>
      </InspectorControls>

      <div {...useBlockProps()}>
        <h3>{attributes.title}</h3>
      </div>
    </>
  );
};

export const save = () => null; // Server-side rendering
```

### 2. PHP Registration

Add to `BlocksServiceProvider`:

```php
add_filter('render_block', function ($blockContent, $block) {
    if ($block['blockName'] === 'radicle/my-block') {
        return view('blocks.my-block', [
            'title' => sanitize_text_field($block['attrs']['title'] ?? 'Block Title'),
        ]);
    }
    return $blockContent;
}, 10, 2);
```

### 3. Blade Template

Create `resources/views/blocks/my-block.blade.php`:

```php
<div class="my-block">
    <h3>{{ $title }}</h3>
    <p>Custom block content</p>
</div>
```

## Block Patterns

Register reusable patterns in `BlocksServiceProvider`:

```php
add_action('init', function () {
    register_block_pattern('radicle/hero', [
        'title' => __('Hero Section', 'radicle'),
        'categories' => ['radicle-layouts'],
        'content' => '<!-- wp:heading {"level":1} --><h1>Hero Title</h1><!-- /wp:heading -->'
    ]);
});
```

## Block Style Variations

Add custom styles for existing blocks:

```php
add_action('init', function () {
    register_block_style('core/button', [
        'name' => 'outline',
        'label' => __('Outline', 'radicle'),
    ]);
});
```

## Overriding Core Blocks

Override core blocks with Blade components (see existing modal block in codebase):

```php
add_filter('render_block', function ($blockContent, $block) {
    if ($block['blockName'] === 'core/button') {
        return view('blocks.button', ['text' => 'Button Text']);
    }
    return $blockContent;
}, 10, 2);
```

## Best Practices

- **Security**: Always sanitize block attributes
- **Performance**: Load block assets conditionally with `has_block()`
- **Accessibility**: Include proper ARIA labels
- **Testing**: Write E2E tests for block functionality

See existing blocks in `resources/js/editor/` for reference implementations.