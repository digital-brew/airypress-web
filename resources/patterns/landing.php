<?php

/**
 * The AiryPress landing page as a list of `airypress/*` blocks and their attributes.
 * Registered as the "AiryPress landing page" block pattern.
 */

$item = fn (string $icon, string $title, string $text): array => compact('icon', 'title', 'text');
$row = fn (string $label, string ...$values): array => compact('label', 'values');

return [
    'hero' => [
        'badge' => 'Free on WordPress.org',
        'heading' => 'wp-admin, but calm.',
        'text' => 'AiryPress turns wp-admin into a clean, modern, branded workspace — a calm sidebar, only the menus that matter, no plugin clutter. Set it up once, reuse it on every site.',
        'primaryText' => 'Download free',
        'primaryUrl' => '#',
        'secondaryText' => 'Try the live demo',
        'secondaryUrl' => '#',
        'stickerOne' => '5 menus, not 50',
        'stickerTwo' => 'Plugin badges: hidden',
    ],
    'intro' => [
        'eyebrow' => '#ClientReady',
        'heading' => 'The WordPress admin your clients deserve, the way it should have looked all along.',
        'text' => 'Your client logs in and sees a calm, branded workspace — not a wall of plugin menus, upsell notices and toolbar badges. Fewer menus, fewer nags, fewer support calls.',
    ],
    'highlights' => [
        'items' => [
            $item('layers', 'A layer, not a replacement', 'Never deregisters WordPress styles.'),
            $item('plug-check', '45+ plugins tested', 'Checked page by page, desktop and mobile.'),
            $item('pointer', 'Feels instant', 'Hover prefetch and smooth page transitions.'),
            $item('terminal', 'Composer friendly', 'Built assets, Bedrock ready, no build step.'),
        ],
    ],
    'video' => [
        'caption' => '[90-second demo video — light sidebar, demo WooCommerce store]',
    ],
    'features' => [
        'heading' => 'Why AiryPress, you ask?',
        'cardOneTitle' => 'Dark frame',
        'cardOneLabel' => 'Free',
        'cardTwoTitle' => 'Light sheet',
        'cardTwoLabel' => 'Pro',
        'items' => [
            $item('menu-builder', 'A menu builder clients get', 'Drag, nest four levels deep, rename, add links and labels, hide items per role.'),
            $item('cleanup', 'Plugin clutter, gone', 'Keep only the toolbar items and dashboard widgets you tick — the ones plugins add too.'),
            $item('columns', 'Columns that fit', 'Order, hide and sort list columns per post type — featured image, slug, any ACF field.'),
            $item('key', 'Ready for handover', 'Branded login, a proper maintenance page, Open Graph cards and GA4 in the dashboard.'),
        ],
    ],
    'comparison' => [
        'heading' => 'How we compare',
        'columns' => ['AiryPress', 'ASE', 'WP Adminify'],
        'rows' => [
            $row('Designed admin theme, dark + light', 'Yes', 'Basic styling', 'Themes / presets'),
            $row('Hide plugin toolbar items &amp; widgets', 'Yes', 'Partial', 'Partial'),
            $row('GA4 dashboard + live visitors', 'Yes', '—', '—'),
            $row('Page prefetch + transitions', 'Yes', '—', '—'),
            $row('Admin columns with ACF', 'Yes', 'Yes', 'Yes'),
            $row('Pro from', '$59 / year', '$39 / year', '$79 / year'),
        ],
        'chips' => ['Free on WordPress.org', 'No upsell nags', 'Block editor untouched', 'Export / import JSON', 'Bedrock friendly'],
        'testedLabel' => 'Tested with',
        'tested' => [
            'WooCommerce',
            'Gravity Forms',
            'Gravity SMTP',
            'Yoast SEO',
            'SEOPress',
            'ACF PRO',
            'ACF Extended',
            'ACF QuickEdit Fields',
            'MonsterInsights',
            'The Events Calendar',
            'All-in-One WP Migration',
            'WPConsent',
            'Beautiful Cookie Consent',
            'Redirection',
            'Akismet',
            'Complianz',
            'CookieAdmin',
            'Cookie Bar',
            'Cookiebot',
            'Cookie Notice',
            'iubenda',
            'TablePress',
            'Contact Form 7',
            'Post Types Order',
            'Duplicate Page',
            'Enable Media Replace',
            'Safe SVG',
            'Simple Custom CSS and JS',
            'HubSpot',
            'Meta Pixel',
            'ShareThis',
            'Social Intents',
            'Better Click To Share',
            'Really Simple Security',
            'Two Factor',
            'WP Migrate',
            'Spatie Ray',
            'Query Monitor',
        ],
    ],
    'pricing' => [
        'heading' => 'Free forever. Pro when you hand over.',
        'text' => 'Every plan includes all Pro features. Pick by the number of sites — pay yearly, or once for life.',
        'yearlyLabel' => 'Yearly',
        'lifetimeLabel' => 'Lifetime',
        'lifetimeBadge' => 'Pay once',
        'featuredBadge' => 'Most agencies',
        'ctaPrefix' => 'Get',
        'plans' => [
            ['name' => 'Personal', 'sites' => '1 site', 'yearly' => '$59', 'lifetime' => '$179', 'featured' => false, 'url' => '#'],
            ['name' => 'Business', 'sites' => '5 sites', 'yearly' => '$129', 'lifetime' => '$389', 'featured' => true, 'url' => '#'],
            ['name' => 'Agency', 'sites' => 'Unlimited sites', 'yearly' => '$249', 'lifetime' => '$749', 'featured' => false, 'url' => '#'],
        ],
        'footnote' => '14-day money-back guarantee · Launch offer: 40% off the first year or the first 100 lifetime licences · Yearly plans keep working after expiry — you just stop getting updates',
    ],
    'story' => [
        'heading' => 'Hand over the site. Not the clutter.',
        'text' => 'A stock wp-admin greets clients with plugin menus, upsell notices and toolbar badges. AiryPress clears it away before they ever log in.',
        'rows' => [
            ['title' => 'Fewer menus.', 'text' => 'Clients see five menus, not fifty — in the order you choose.'],
            ['title' => 'Fewer nags.', 'text' => 'Upsell notices, update nags and plugin badges, out of sight.'],
            ['title' => 'Fewer support calls.', 'text' => 'A calm, branded workspace where everything is easy to find.'],
        ],
    ],
    'reviews' => [
        'heading' => 'Handed over &amp; happy',
        'items' => [
            ['title' => 'No more "where is it?"', 'quote' => '“Our clients stopped asking where things are.”', 'name' => '[Name]', 'role' => 'Agency owner'],
            ['title' => 'Shopify vibes', 'quote' => '“It made our WooCommerce admin feel like Shopify.”', 'name' => '[Name]', 'role' => 'Store manager'],
            ['title' => '[Review title]', 'quote' => '[Third review from a real user]', 'name' => '[Name]', 'role' => '[Role]'],
        ],
    ],
    'faq' => [
        'heading' => 'FAQs',
        'items' => [
            ['question' => 'Will it break my site?', 'answer' => 'No core styles are replaced. Turn the theme off any time; every other setting keeps working.'],
            ['question' => 'Does it work with the block editor?', 'answer' => 'Yes — the editor keeps its own layout and only picks up your accent colour.'],
            ['question' => 'Can clients undo it?', 'answer' => 'Settings live under Settings → AiryPress, for administrators only. Client mode is on the roadmap.'],
            ['question' => 'Does it slow down the admin?', 'answer' => 'It speeds it up: hover prefetch, page transitions and a lighter dashboard.'],
            ['question' => 'What happens when Pro expires?', 'answer' => 'Everything keeps working; you just stop getting updates and support.'],
            ['question' => 'Refunds?', 'answer' => '14 days, no questions.'],
        ],
    ],
];
