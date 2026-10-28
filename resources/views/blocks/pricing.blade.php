@php
    $yearlyPeriod = $yearlyPeriod ?: __('/ year', 'radicle');
    $lifetimePeriod = $lifetimePeriod ?: __('once', 'radicle');
    $yearlyNote = $yearlyNote ?: __('or {lifetime} lifetime', 'radicle');
    $lifetimeNote = $lifetimeNote ?: __('One-time payment · or {yearly} / year', 'radicle');
    $note = fn (string $template, array $plan): string => strtr($template, [
        '{yearly}' => $plan['yearly'] ?? '',
        '{lifetime}' => $plan['lifetime'] ?? '',
    ]);

    // Plan card colors as CSS variables, so normal and featured plans share one set of classes
    $planStyle = '--card-bg: var(--c-card-bg, var(--color-sky)); --card-text: var(--c-card-text, var(--color-ink)); --card-muted: var(--c-card-muted, var(--color-ink-soft)); --btn-bg: var(--c-button-bg, var(--color-ink)); --btn-text: var(--c-button-text, var(--color-white))';
    $featuredStyle = '--card-bg: var(--c-featured-bg, var(--color-brand)); --card-text: var(--c-featured-text, var(--color-white)); --card-muted: var(--c-featured-muted, var(--color-ice)); --btn-bg: var(--c-featured-button-bg, var(--color-white)); --btn-text: var(--c-featured-button-text, var(--color-ink))';

    // Freemius checkout: plans with licences open it (see resources/js/components/pricing.js)
    $checkout = [
        'productId' => (string) config('freemius.product_id'),
        'publicKey' => (string) config('freemius.public_key'),
        'planId' => trim(wp_strip_all_tags($checkoutPlanId ?? '')),
    ];
    $canCheckout = $checkout['productId'] !== '' && $checkout['publicKey'] !== '' && $checkout['planId'] !== '';
    $licensesOf = fn (array $plan): string => $canCheckout ? trim(wp_strip_all_tags((string) ($plan['licenses'] ?? ''))) : '';
    $checkoutUrl = fn (string $licenses): string => "https://checkout.freemius.com/plugin/{$checkout['productId']}/plan/{$checkout['planId']}/?" . http_build_query([
        'licenses' => $licenses,
        'billing_cycle' => 'annual',
    ]);
@endphp

<section {!! $wrapper('bg-[var(--c-bg,transparent)] px-6 py-28') !!} x-data="pricing({{ \Illuminate\Support\Js::from($checkout) }})">
    <div class="shell flex flex-col gap-10">
        <div class="flex flex-col items-center gap-4 text-center">
            @if ($heading)
                <h2 class="section-title text-[var(--c-heading,var(--color-ink))]">{!! $heading !!}</h2>
            @endif

            @if ($text)
                <p class="m-0 max-w-[600px] text-lg text-[var(--c-text,var(--color-ink-soft))]">{!! $text !!}</p>
            @endif

            <div role="group" aria-label="{{ __('Billing period', 'radicle') }}" class="inline-flex gap-1 rounded-full bg-[var(--c-toggle-bg,var(--color-sky))] p-1.5">
                <button type="button" aria-pressed="true" :aria-pressed="(! lifetime).toString()" @click="lifetime = false" class="pill min-h-11 cursor-pointer px-5 text-[15px] text-[var(--c-toggle-text,var(--color-ink))] hover:transform-none hover:shadow-none active:transform-none active:shadow-none aria-pressed:bg-[var(--c-toggle-active-bg,var(--color-ink))] aria-pressed:text-[var(--c-toggle-active-text,var(--color-white))]">
                    {!! $yearlyLabel ?: __('Yearly', 'radicle') !!}
                </button>
                <button type="button" aria-pressed="false" :aria-pressed="lifetime.toString()" @click="lifetime = true" class="pill min-h-11 cursor-pointer gap-2 px-5 text-[15px] text-[var(--c-toggle-text,var(--color-ink))] hover:transform-none hover:shadow-none active:transform-none active:shadow-none aria-pressed:bg-[var(--c-toggle-active-bg,var(--color-ink))] aria-pressed:text-[var(--c-toggle-active-text,var(--color-white))]">
                    {!! $lifetimeLabel ?: __('Lifetime', 'radicle') !!}
                    @if ($lifetimeBadge)
                        <span class="rounded-full bg-[var(--c-badge-bg,var(--color-sun))] px-2 py-0.5 text-xs font-bold text-[var(--c-badge-text,var(--color-ink))]">{!! $lifetimeBadge !!}</span>
                    @endif
                </button>
            </div>
        </div>

        <div class="grid grid-cols-[repeat(auto-fit,minmax(min(300px,100%),1fr))] gap-4">
            @foreach ($plans as $plan)
                @php($featured = ! empty($plan['featured']))

                <div class="flex flex-col gap-3.5 rounded-[1.25rem] bg-(--card-bg) p-9 text-(--card-text)" style="{{ $featured ? $featuredStyle : $planStyle }}">
                    <div class="flex items-center justify-between gap-2">
                        <h3 class="m-0 text-[22px] font-bold">{!! $plan['name'] ?? '' !!}</h3>
                        @if ($featured && $featuredBadge)
                            <span class="rounded-full bg-[var(--c-badge-bg,var(--color-sun))] px-3 py-1.5 text-[13px] font-bold text-[var(--c-badge-text,var(--color-ink))]">{!! $featuredBadge !!}</span>
                        @endif
                    </div>

                    <span class="text-(--card-muted)">{!! $plan['sites'] ?? '' !!}</span>

                    <div class="flex items-baseline gap-1.5">
                        <span class="font-display text-[64px] leading-none font-extrabold tracking-[-0.03em]">
                            <span x-show="! lifetime">{!! $plan['yearly'] ?? '' !!}</span>
                            <span x-show="lifetime" x-cloak>{!! $plan['lifetime'] ?? '' !!}</span>
                        </span>
                        <span class="text-(--card-muted)">
                            <span x-show="! lifetime">{!! $yearlyPeriod !!}</span>
                            <span x-show="lifetime" x-cloak>{!! $lifetimePeriod !!}</span>
                        </span>
                    </div>

                    <span class="text-[15px] text-(--card-muted)">
                        <span x-show="! lifetime">{!! $note($yearlyNote, $plan) !!}</span>
                        <span x-show="lifetime" x-cloak>{!! $note($lifetimeNote, $plan) !!}</span>
                    </span>

                    @php($licenses = $licensesOf($plan))
                    <a
                        @if ($licenses !== '')
                            href="{!! esc_url($checkoutUrl($licenses)) !!}"
                            :href="url({{ \Illuminate\Support\Js::from($licenses) }})"
                            @click="buy($event, {{ \Illuminate\Support\Js::from($licenses) }})"
                        @else
                            href="{{ esc_url(($plan['url'] ?? '') ?: '#') }}"
                        @endif
                        class="pill mt-2.5 min-h-[52px] bg-(--btn-bg) text-(--btn-text) hover:brightness-110"
                    >
                        {!! trim(($ctaPrefix ?: __('Get', 'radicle')) . ' ' . ($plan['name'] ?? '')) !!}
                    </a>
                </div>
            @endforeach
        </div>

        @if ($footnote)
            <p class="m-0 text-center text-[15px] text-[var(--c-text,var(--color-ink-soft))]">{!! $footnote !!}</p>
        @endif
    </div>
</section>
