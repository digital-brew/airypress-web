{{-- Details sharing a `name` form an exclusive accordion: opening one closes the others --}}
@php($group = wp_unique_id('faq-'))

<section {!! $wrapper('bg-[var(--c-bg,transparent)] px-6 pb-28') !!}>
    <div class="mx-auto flex max-w-[900px] flex-col gap-8">
        @if ($heading)
            <h2 class="section-title text-center text-[var(--c-heading,var(--color-ink))]">{!! $heading !!}</h2>
        @endif

        <div class="flex flex-col gap-2.5">
            @foreach ($items as $item)
                <details name="{{ $group }}" class="accordion group rounded-3xl bg-[var(--c-item-bg,var(--color-sky))] px-7 py-[22px]">
                    <summary class="flex min-h-7 cursor-pointer list-none items-center justify-between gap-4 text-lg font-bold text-[var(--c-question,var(--color-ink))] [&::-webkit-details-marker]:hidden">
                        {!! $item['question'] ?? '' !!}
                        <svg class="size-5 flex-none text-[var(--c-icon,var(--color-brand))] transition-transform duration-300 group-open:-rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6" /></svg>
                    </summary>
                    <p class="m-0 mt-2.5 text-[var(--c-answer,var(--color-ink-soft))]">{!! $item['answer'] ?? '' !!}</p>
                </details>
            @endforeach
        </div>
    </div>
</section>
