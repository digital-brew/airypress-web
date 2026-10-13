@php
    $cards = [
        [
            'image' => $cardOneMediaId,
            'title' => $cardOneTitle,
            'label' => $cardOneLabel,
            'class' => '',
            'style' => '--card-bg: var(--c-card-one-bg, var(--color-brand)); --card-title: var(--c-card-one-title, var(--color-white)); --card-label: var(--c-card-one-label, var(--color-ice))',
        ],
        [
            'image' => $cardTwoMediaId,
            'title' => $cardTwoTitle,
            'label' => $cardTwoLabel,
            'class' => 'mt-12',
            'style' => '--card-bg: var(--c-card-two-bg, var(--color-sky)); --card-title: var(--c-card-two-title, var(--color-ink)); --card-label: var(--c-card-two-label, var(--color-ink-soft))',
        ],
    ];
@endphp

<section {!! $wrapper('bg-[var(--c-bg,transparent)] px-6 py-28') !!}>
    <div class="shell flex flex-wrap items-center gap-14">
        <div class="grid min-w-0 flex-[1_1_440px] grid-cols-2 gap-4">
            @foreach ($cards as $card)
                {{-- Preview card: an uploaded image, or the colored card mockup when there is none --}}
                <div class="relative flex aspect-[3/4] flex-col justify-end overflow-hidden rounded-[32px] bg-(--card-bg) p-5 {{ $card['class'] }}" style="{{ $card['style'] }}">
                    @if ($card['image'])
                        {!! wp_get_attachment_image($card['image'], 'large', false, ['class' => 'absolute inset-0 size-full object-cover']) !!}
                        @if ($card['title'] || $card['label'])
                            <span class="absolute inset-x-0 bottom-0 h-1/2 bg-linear-to-t from-ink/70 to-transparent" aria-hidden="true"></span>
                        @endif
                    @endif
                    <span class="relative font-display text-[26px] leading-none font-extrabold text-(--card-title)">{!! $card['title'] !!}</span>
                    <span class="relative text-sm text-(--card-label)">{!! $card['label'] !!}</span>
                </div>
            @endforeach
        </div>

        <div class="flex min-w-0 flex-[1_1_520px] flex-col gap-8">
            @if ($heading)
                <h2 class="section-title text-[var(--c-heading,var(--color-ink))]">{!! $heading !!}</h2>
            @endif

            <div class="grid grid-cols-[repeat(auto-fit,minmax(min(240px,100%),1fr))] gap-7">
                @foreach ($items as $item)
                    <div class="flex flex-col gap-2.5">
                        <span class="icon-tile size-[76px] rounded-3xl bg-[var(--c-tile-bg,var(--color-sun))]">
                            <x-card-icon :item="$item" class="size-12" />
                        </span>
                        <h3 class="m-0 text-[19px] font-bold text-[var(--c-title,var(--color-ink))]">{!! $item['title'] ?? '' !!}</h3>
                        <p class="m-0 text-base text-[var(--c-text,var(--color-ink-soft))]">{!! $item['text'] ?? '' !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
