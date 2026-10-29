<?php

/**
 * The AiryPress landing page as a list of `airypress/*` blocks and their attributes.
 * Registered as the "AiryPress landing page" block pattern.
 */

$item = fn (string $icon, string $title, string $text): array => compact('icon', 'title', 'text');
$row = fn (string $label, string ...$values): array => compact('label', 'values');

return [
    'hero' => [
        'badge' => 'Free and open source',
        'heading' => 'wp-admin, but calm.',
        'text' => 'AiryPress turns wp-admin into a clean, modern, branded workspace — a calm sidebar, only the menus that matter, no plugin clutter. Set it up once, reuse it on every site.',
        'primaryText' => 'Download free',
        'primaryUrl' => '/download/airypress.zip',
        'secondaryText' => 'Try the live demo',
        'secondaryUrl' => 'https://trydemowp.com/try/airypress',
        'stickerOne' => '5 menus, not 50',
        'stickerTwo' => 'Plugin badges: hidden',
        'stickerThree' => 'Your brand colour',
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
        'eyebrow' => 'Two-minute demo',
        'heading' => 'See the calm in action.',
        'text' => 'One demo store, start to finish: switch the theme, rebuild the menu, hide the plugin clutter and get it ready for handover.',
        'caption' => 'Watch the demo',
        'chapters' => [
            ['title' => 'Theme &amp; colour', 'time' => '0:07'],
            ['title' => 'Menu builder', 'time' => '0:20'],
            ['title' => 'Plugin clean-up', 'time' => '0:39'],
            ['title' => 'Columns', 'time' => '0:51'],
            ['title' => 'Handover', 'time' => '1:05'],
        ],
    ],
    'features' => [
        'heading' => 'Why AiryPress, you ask?',
        'text' => 'Four things agencies set up on every site — now done once, in one plugin.',
        'items' => [
            ['visual' => 'menu', 'title' => 'A menu builder clients get', 'text' => 'Drag, nest four levels deep, rename, add links and labels, hide items per role.'],
            ['visual' => 'toolbar', 'title' => 'Plugin clutter, gone', 'text' => 'Keep only the toolbar items and dashboard widgets you tick — the ones plugins add too.'],
            ['visual' => 'columns', 'title' => 'Columns that fit', 'text' => 'Order, hide and sort list columns per post type — featured image, slug, any ACF field.'],
            ['visual' => 'handover', 'title' => 'Ready for handover', 'text' => 'Branded login, a proper maintenance page, Open Graph cards and GA4 in the dashboard.'],
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
        'chips' => ['Free and open source', 'No upsell nags', 'Block editor untouched', 'Export / import JSON', 'Bedrock friendly'],
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
        'featuredBadge' => 'Most popular',
        'ctaPrefix' => 'Get',
        'plans' => [
            ['name' => 'Personal', 'sites' => '1 site', 'yearly' => '$59', 'lifetime' => '$179', 'featured' => false, 'licenses' => '1', 'url' => '#'],
            ['name' => 'Business', 'sites' => '5 sites', 'yearly' => '$129', 'lifetime' => '$389', 'featured' => true, 'licenses' => '5', 'url' => '#'],
            ['name' => 'Agency', 'sites' => 'Unlimited sites', 'yearly' => '$249', 'lifetime' => '$749', 'featured' => false, 'licenses' => 'unlimited', 'url' => '#'],
        ],
        'footnote' => '14-day money-back guarantee · Launch offer: 35% off your first year with code <strong>EARLYBIRD</strong> · Yearly plans keep working after expiry — you just stop getting updates',
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
