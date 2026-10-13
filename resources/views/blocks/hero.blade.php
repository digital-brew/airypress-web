<section {!! $wrapper('gutter overflow-hidden bg-[var(--c-bg,var(--color-brand))] pb-[clamp(40px,6vw,80px)] text-white first:-mt-(--nav-height) first:pt-(--nav-height)') !!}>
    <div class="shell flex flex-wrap items-center gap-14 pt-[clamp(32px,6vw,72px)]">
        <div class="flex min-w-0 flex-[1_1_460px] flex-col gap-[26px]">
            @if ($badge)
                <span class="self-start rounded-full bg-[var(--c-badge-bg,var(--color-sun))] px-4 py-2 text-sm font-bold text-[var(--c-badge-text,var(--color-ink))]">{!! $badge !!}</span>
            @endif

            @if ($heading)
                <h1 class="headline text-[clamp(56px,8vw,112px)] leading-[0.92] tracking-[-0.04em] text-[var(--c-heading,var(--color-white))]">{!! $heading !!}</h1>
            @endif

            @if ($text)
                <p class="m-0 max-w-[520px] text-xl text-[var(--c-text,var(--color-ice))]">{!! $text !!}</p>
            @endif

            @if ($primaryText || $secondaryText)
                <div class="flex flex-wrap gap-3">
                    @if ($primaryText)
                        <a href="{{ esc_url($primaryUrl ?: '#') }}" class="pill group min-h-14 bg-[var(--c-primary-bg,var(--color-ink))] px-[30px] text-[17px] text-[var(--c-primary-text,var(--color-white))] hover:brightness-110">
                            {!! $primaryText !!}
                            @include('partials.arrow')
                        </a>
                    @endif

                    @if ($secondaryText)
                        <a href="{{ esc_url($secondaryUrl ?: '#') }}" class="pill group min-h-14 bg-[var(--c-secondary-bg,var(--color-white))] px-[30px] text-[17px] text-[var(--c-secondary-text,var(--color-ink))] hover:brightness-110">
                            @include('partials.play-outline')
                            {!! $secondaryText !!}
                        </a>
                    @endif
                </div>
            @endif
        </div>

        <div class="relative min-w-0 flex-[1_1_520px] py-6">
            @if ($mediaId)
                <div class="rounded-[32px] bg-white p-3 shadow-[0_40px_80px_-30px_rgba(6,47,63,0.55)]">
                    {!! wp_get_attachment_image($mediaId, 'large', false, array_filter(['class' => 'block h-auto w-full rounded-3xl', 'alt' => $mediaAlt])) !!}
                </div>
            @else
                @include('partials.hero-mockup')
            @endif

            @if ($stickerOne)
                <span class="absolute top-0 -left-3 -rotate-4 rounded-full bg-[var(--c-sticker-one-bg,var(--color-sun))] px-[18px] py-3 text-[15px] font-bold text-[var(--c-sticker-one-text,var(--color-ink))] shadow-[0_12px_24px_-12px_rgba(6,47,63,0.5)]">{!! $stickerOne !!}</span>
            @endif

            @if ($stickerTwo)
                <span class="absolute right-3 bottom-0 rotate-3 rounded-full bg-[var(--c-sticker-two-bg,var(--color-ink))] px-[18px] py-3 text-[15px] font-bold text-[var(--c-sticker-two-text,var(--color-white))] shadow-[0_12px_24px_-12px_rgba(6,47,63,0.5)]">{!! $stickerTwo !!}</span>
            @endif
        </div>
    </div>
</section>
