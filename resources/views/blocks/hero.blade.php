<section {!! $wrapper('gutter relative isolate overflow-x-clip pb-[clamp(24px,3vw,40px)] text-white first:-mt-(--nav-height) first:pt-(--nav-height)') !!}>
    {{-- Brand panel; stops partway down the product visual so it hangs over the next section --}}
    <span class="absolute inset-x-0 top-0 bottom-[clamp(140px,24vw,340px)] -z-10 bg-[var(--c-bg,var(--color-brand))]" aria-hidden="true"></span>

    <div class="shell flex flex-col items-center gap-7 pt-[clamp(48px,7vw,100px)] text-center">
        @if ($badge)
            <span class="rounded-full bg-[var(--c-badge-bg,var(--color-sun))] px-4 py-2 text-sm font-bold text-[var(--c-badge-text,var(--color-ink))]">{!! $badge !!}</span>
        @endif

        @if ($heading)
            @php
                // The tight tracking pushes punctuation into the letters: give - , . a little room (text only, not tags)
                $heading = preg_replace_callback('/(?<=^|>)[^<]+/', fn (array $text): string => preg_replace_callback(
                    '/[-,.]/',
                    // The hyphen is narrowed to 65% (its trimmed ink is the gap) and written as an entity,
                    // or wptexturize turns a lone "-" into an en dash
                    fn (array $mark): string => $mark[0] === '-' ? '<span class="inline-block scale-x-[0.65]">&#45;</span>' : '<span class="ml-[0.05em]">' . $mark[0] . '</span>',
                    $text[0],
                ), $heading);
            @endphp
            <h1 class="headline max-w-[1000px] text-[clamp(60px,11vw,150px)] leading-[0.88] tracking-[-0.05em] text-[var(--c-heading,var(--color-white))]">{!! $heading !!}</h1>
        @endif

        @if ($text)
            <p class="m-0 max-w-[640px] text-[clamp(18px,1.6vw,21px)] text-[var(--c-text,var(--color-ice))]">{!! $text !!}</p>
        @endif

        @if ($primaryText || $secondaryText)
            <div class="flex flex-wrap justify-center gap-3">
                @if ($primaryText)
                    <a href="{{ esc_url($primaryUrl ?: '#') }}" @if (str_starts_with($primaryUrl, 'http')) target="_blank" rel="noopener" @endif class="pill min-h-14 bg-[var(--c-primary-bg,var(--color-ink))] px-[30px] text-[17px] text-[var(--c-primary-text,var(--color-white))] hover:brightness-110">{!! $primaryText !!}</a>
                @endif

                @if ($secondaryText)
                    <a href="{{ esc_url($secondaryUrl ?: '#') }}" class="pill min-h-14 bg-[var(--c-secondary-bg,var(--color-white))] px-[30px] text-[17px] text-[var(--c-secondary-text,var(--color-ink))] hover:brightness-110">
                        <svg class="size-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7 4.8v14.4a1 1 0 0 0 1.5.86l11.7-7.2a1 1 0 0 0 0-1.72L8.5 3.94A1 1 0 0 0 7 4.8z" /></svg>
                        {!! $secondaryText !!}
                    </a>
                @endif
            </div>
        @endif
    </div>

    <div class="relative mx-auto mt-[clamp(48px,6vw,80px)] max-w-[1200px]">
        <div class="rounded-[1.25rem] bg-white p-[clamp(8px,1.1vw,16px)] pt-0 shadow-[0_40px_80px_-30px_rgba(6,47,63,0.45)]">
            <div class="relative flex min-h-[clamp(44px,4.5vw,64px)] items-center justify-center" aria-hidden="true">
                <span class="absolute left-[clamp(8px,1.5vw,20px)] flex gap-2">
                    <span class="size-3 rounded-full bg-line"></span><span class="size-3 rounded-full bg-line"></span><span class="size-3 rounded-full bg-line"></span>
                </span>
                <span class="rounded-full bg-mist px-4 py-1.5 text-sm text-ink-soft max-sm:hidden">clientco.com/wp-admin</span>
            </div>

            @if ($mediaId)
                {!! wp_get_attachment_image($mediaId, 'full', false, array_filter(['class' => 'block h-auto w-full rounded-[1.25rem]', 'alt' => $mediaAlt])) !!}
            @else
                @include('partials.hero-mockup')
            @endif
        </div>

        @if ($stickerOne)
            <span class="absolute -top-7 -left-2 -rotate-4 rounded-full bg-[var(--c-sticker-one-bg,var(--color-sun))] px-5 py-3.5 font-display text-[clamp(15px,1.4vw,19px)] font-bold text-[var(--c-sticker-one-text,var(--color-ink))] shadow-[0_12px_24px_-12px_rgba(6,47,63,0.5)]">{!! $stickerOne !!}</span>
        @endif

        @if ($stickerTwo)
            <span class="absolute top-[28%] -right-2 rotate-3 rounded-full bg-[var(--c-sticker-two-bg,var(--color-ink))] px-5 py-3.5 font-display text-[clamp(15px,1.4vw,19px)] font-bold text-[var(--c-sticker-two-text,var(--color-white))] shadow-[0_12px_24px_-12px_rgba(6,47,63,0.5)]">{!! $stickerTwo !!}</span>
        @endif

        @if ($stickerThree)
            <span class="absolute -bottom-6 left-[12%] flex -rotate-2 items-center gap-3 rounded-full bg-[var(--c-sticker-three-bg,var(--color-white))] px-5 py-3.5 font-display text-[clamp(15px,1.4vw,19px)] font-bold text-[var(--c-sticker-three-text,var(--color-ink))] shadow-[0_12px_24px_-12px_rgba(6,47,63,0.5)]">
                <span class="size-4 flex-none rounded-full bg-[var(--c-sticker-three-dot,var(--color-brand))]"></span>{!! $stickerThree !!}
            </span>
        @endif
    </div>
</section>
