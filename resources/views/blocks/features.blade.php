@php
    // Each card's look follows its illustration; mirrors `looks` in resources/js/editor/blocks/features/edit.jsx
    $looks = [
        'menu' => '--card-bg: var(--c-menu-bg, var(--color-sky)); --card-title: var(--c-menu-title, var(--color-ink)); --card-text: var(--c-menu-text, var(--color-ink-soft)); --panel-bg: var(--color-white)',
        'toolbar' => '--card-bg: var(--c-toolbar-bg, var(--color-ink)); --card-title: var(--c-toolbar-title, var(--color-white)); --card-text: var(--c-toolbar-text, var(--color-ice)); --panel-bg: rgb(255 255 255 / 0.05)',
        'columns' => '--card-bg: var(--c-columns-bg, var(--color-sun)); --card-title: var(--c-columns-title, var(--color-ink)); --card-text: var(--c-columns-text, var(--color-ink-soft)); --panel-bg: var(--color-white)',
        'handover' => '--card-bg: var(--c-handover-bg, var(--color-brand)); --card-title: var(--c-handover-title, var(--color-white)); --card-text: var(--c-handover-text, var(--color-ice)); --panel-bg: rgb(255 255 255 / 0.15)',
    ];
    $visuals = array_keys($looks);
@endphp

<section {!! $wrapper('bg-[var(--c-bg,transparent)] px-6 py-28') !!}>
    <div class="shell flex flex-col gap-12">
        @if ($heading || $text)
            <div class="flex flex-wrap items-center justify-between gap-x-10 gap-y-4">
                @if ($heading)
                    <h2 class="headline min-w-0 flex-[1_1_560px] text-[clamp(44px,6vw,80px)] leading-[0.95] tracking-[-0.04em] text-[var(--c-heading,var(--color-ink))]">{!! $heading !!}</h2>
                @endif
                @if ($text)
                    <p class="m-0 max-w-[400px] flex-[0_1_400px] text-lg text-[var(--c-text,var(--color-ink-soft))]">{!! $text !!}</p>
                @endif
            </div>
        @endif

        <div class="grid gap-4 md:grid-cols-2">
            @foreach ($items as $index => $item)
                @php($visual = in_array($item['visual'] ?? '', $visuals, true) ? $item['visual'] : $visuals[$index % count($visuals)])
                <div class="flex flex-col rounded-[1.25rem] bg-(--card-bg) p-4" style="{{ $looks[$visual] }}">
                    <div class="flex min-h-[clamp(240px,24vw,320px)] items-center rounded-[1.25rem] bg-(--panel-bg) p-[clamp(16px,2vw,28px)]">
                        @if (! empty($item['mediaId']))
                            {!! wp_get_attachment_image($item['mediaId'], 'large', false, ['class' => 'block h-auto w-full rounded-2xl']) !!}
                        @else
                            @include('partials.feature-visual')
                        @endif
                    </div>
                    <div class="flex flex-col gap-3 px-4 pt-7 pb-6">
                        <h3 class="m-0 font-display text-[clamp(24px,2.4vw,30px)] leading-tight font-extrabold tracking-[-0.02em] text-(--card-title)">{!! $item['title'] ?? '' !!}</h3>
                        <p class="m-0 text-[17px] text-(--card-text)">{!! $item['text'] ?? '' !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
