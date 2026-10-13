<?php

namespace App\View\Composers;

use Log1x\Navi\Navi;
use Roots\Acorn\View\Composer;

class SiteChrome extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'sections.header',
        'sections.footer',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'announcement' => wp_kses($this->option('announcement'), [
                'strong' => [],
                'em' => [],
                'a' => ['href' => [], 'target' => [], 'rel' => []],
            ]),
            'logo' => $this->logo(),
            'headerCta' => $this->link('header_cta'),
            'primaryNavigation' => $this->withSections(Navi::make()->build('primary_navigation')),
            'footerNavigation' => Navi::make()->build('footer_navigation'),
            'footerTagline' => $this->option('footer_tagline'),
            'newsletter' => $this->newsletter(),
            'copyright' => str_replace('{year}', wp_date('Y'), $this->option('copyright')),
            'legalNote' => $this->option('legal_note'),
        ];
    }

    /**
     * Mark menu items as current for every page in their section, not just their exact URL:
     * "Docs" (/docs/) stays highlighted on each doc and on pages using the docs template.
     * Anchor links (/#pricing) are never current.
     */
    protected function withSections(Navi $menu): Navi
    {
        $current = is_page_template('template-docs.blade.php')
            ? (string) get_post_type_archive_link('doc')
            : home_url(add_query_arg([]));
        $currentPath = trailingslashit((string) wp_parse_url($current, PHP_URL_PATH));

        foreach ($menu->all() as $item) {
            $path = trailingslashit((string) wp_parse_url($item->url, PHP_URL_PATH));
            $inSection = $path !== '/' && str_starts_with($currentPath, $path);
            $item->active = ! str_contains($item->url, '#') && ($item->active || $inSection);
        }

        return $menu;
    }

    /**
     * Klaviyo subscription settings, or null when the form cannot submit anywhere.
     */
    protected function newsletter(): ?array
    {
        $publicKey = get_option('klaviyo_settings')['klaviyo_public_api_key'] ?? '';
        $listId = $this->option('klaviyo_list_id');

        if (! $publicKey || ! $listId) {
            return null;
        }

        return [
            'label' => $this->option('newsletter_label'),
            'publicKey' => trim($publicKey),
            'listId' => $listId,
        ];
    }

    /**
     * URL of the uploaded logo, or null to fall back to the default mark and site title.
     */
    protected function logo(): ?string
    {
        $id = (int) $this->option('logo');

        return $id ? (wp_get_attachment_url($id) ?: null) : null;
    }

    /**
     * An ACF link field as ['url', 'title', 'target'], or null when empty.
     */
    protected function link(string $name): ?array
    {
        $link = function_exists('get_field') ? get_field($name, 'option') : null;

        return is_array($link) && ! empty($link['url']) ? $link : null;
    }

    protected function option(string $name): string
    {
        return function_exists('get_field') ? (string) get_field($name, 'option') : '';
    }
}
