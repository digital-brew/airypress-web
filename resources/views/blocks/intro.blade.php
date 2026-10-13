<section {!! $wrapper('bg-[var(--c-bg,transparent)] px-6 pt-28 pb-16') !!}>
    <div class="mx-auto flex max-w-[980px] flex-col items-center gap-[22px] text-center">
        @if ($eyebrow)
            <span class="text-[17px] font-bold text-[var(--c-eyebrow,var(--color-brand))]">{!! $eyebrow !!}</span>
        @endif

        @if ($heading)
            <h2 class="headline text-[clamp(38px,5vw,64px)] leading-[1.02] text-[var(--c-heading,var(--color-ink))]">{!! $heading !!}</h2>
        @endif

        @if ($text)
            <p class="m-0 max-w-[640px] text-[19px] text-[var(--c-text,var(--color-ink-soft))]">{!! $text !!}</p>
        @endif
    </div>
</section>
