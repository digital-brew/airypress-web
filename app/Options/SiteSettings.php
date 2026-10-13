<?php

namespace App\Options;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Options as Field;

class SiteSettings extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Site Settings';

    /**
     * The option page menu slug.
     *
     * @var string
     */
    public $slug = 'site-settings';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Site Settings';

    /**
     * The option page menu position.
     *
     * @var int
     */
    public $position = 59;

    /**
     * The option page menu icon.
     *
     * @var string
     */
    public $icon = 'dashicons-admin-site-alt3';

    /**
     * The option page field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('site_settings');

        $fields
            ->addTab('header', ['label' => 'Header'])
            ->addImage('logo', [
                'label' => 'Logo',
                'instructions' => 'Shown in the header at 36px tall. Upload the full logo (mark + wordmark) in its final colors; SVG recommended. Leave empty to show the default mark with the site title.',
                'return_format' => 'id',
                'preview_size' => 'medium',
                'mime_types' => 'svg,png,webp',
            ])
            ->addTextarea('announcement', [
                'label' => 'Announcement bar',
                'instructions' => 'Shown above the header on every page. Leave empty to hide. Allowed HTML: &lt;strong&gt;, &lt;em&gt;, &lt;a&gt;.',
                'rows' => 2,
                'new_lines' => '',
            ])
            ->addLink('header_cta', [
                'label' => 'Header button',
                'return_format' => 'array',
            ])
            ->addTab('footer', ['label' => 'Footer'])
            ->addText('footer_tagline', [
                'label' => 'Tagline',
            ])
            ->addText('newsletter_label', [
                'label' => 'Newsletter label',
            ])
            ->addText('klaviyo_list_id', [
                'label' => 'Klaviyo list ID',
                'instructions' => 'Newsletter sign-ups are added to this list. The form is hidden until this and the Klaviyo public API key (Settings → Klaviyo) are set.',
            ])
            ->addText('copyright', [
                'label' => 'Copyright',
                'instructions' => '<code>{year}</code> is replaced with the current year.',
            ])
            ->addText('legal_note', [
                'label' => 'Legal note',
            ]);

        return $fields->build();
    }
}
