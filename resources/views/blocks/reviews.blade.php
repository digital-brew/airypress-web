<section {!! $wrapper('bg-[var(--c-bg,transparent)] px-6 py-28') !!}>
    <div class="shell flex flex-col gap-10">
        @if ($heading)
            <h2 class="section-title text-center text-[var(--c-heading,var(--color-ink))]">{!! $heading !!}</h2>
        @endif

        <div class="grid grid-cols-[repeat(auto-fit,minmax(min(320px,100%),1fr))] gap-4">
            @foreach ($items as $item)
                <figure class="m-0 flex flex-col gap-4 rounded-[32px] bg-[var(--c-card-bg,var(--color-sky))] p-8">
                    @if (! empty($item['title']))
                        <h3 class="m-0 text-xl font-bold text-[var(--c-title,var(--color-ink))]">{!! $item['title'] !!}</h3>
                    @endif
                    <blockquote class="m-0 text-[17px] text-[var(--c-quote,var(--color-ink-soft))]">{!! $item['quote'] ?? '' !!}</blockquote>
                    <figcaption class="mt-auto text-sm text-[var(--c-name,var(--color-ink))]">
                        <strong>{!! $item['name'] ?? '' !!}</strong>
                        @if (! empty($item['role']))
                            · {!! $item['role'] !!}
                        @endif
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
