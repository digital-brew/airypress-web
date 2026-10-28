@php
    // Rows cycle through three color sets, exposed as CSS variables per row
    $tones = [
        '--row-bg: var(--c-row-one-bg, var(--color-ink)); --row-title: var(--c-row-one-title, var(--color-white)); --row-text: var(--c-row-one-text, var(--color-ice))',
        '--row-bg: var(--c-row-two-bg, var(--color-brand)); --row-title: var(--c-row-two-title, var(--color-white)); --row-text: var(--c-row-two-text, var(--color-ice))',
        '--row-bg: var(--c-row-three-bg, var(--color-white)); --row-title: var(--c-row-three-title, var(--color-ink)); --row-text: var(--c-row-three-text, var(--color-ink-soft))',
    ];
@endphp

<section {!! $wrapper('gutter bg-[var(--c-bg,var(--color-sun))] py-[clamp(56px,7vw,104px)]') !!}>
    <div class="shell flex flex-col gap-12">
        <div class="flex flex-wrap items-end justify-between gap-6">
            @if ($heading)
                <h2 class="headline -mt-[0.085em] flex-[1_1_560px] text-[clamp(48px,7vw,96px)] leading-[0.95] tracking-[-0.04em] text-[var(--c-heading,var(--color-ink))]">{!! $heading !!}</h2>
            @endif

            @if ($text)
                <p class="m-0 flex-[0_1_380px] text-lg text-[var(--c-text,var(--color-ink))]">{!! $text !!}</p>
            @endif
        </div>

        @if ($rows)
            <div class="flex flex-col gap-3">
                @foreach ($rows as $row)
                    <div class="flex flex-wrap items-center justify-between gap-x-8 gap-y-3 rounded-[1.25rem] bg-(--row-bg) px-8 py-6 md:rounded-full" style="{{ $tones[$loop->index % count($tones)] }}">
                        <h3 class="headline text-[clamp(32px,4vw,52px)] text-(--row-title)">{!! $row['title'] ?? '' !!}</h3>
                        <p class="m-0 flex-[0_1_420px] text-[17px] text-(--row-text)">{!! $row['text'] ?? '' !!}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
