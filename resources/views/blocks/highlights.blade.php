<section {!! $wrapper('bg-[var(--c-bg,transparent)] px-6 pb-24') !!}>
    <div class="shell grid grid-cols-2 gap-3 md:grid-cols-[repeat(auto-fit,minmax(min(16.25rem,100%),1fr))] md:gap-4">
        @foreach ($items as $item)
            <div class="flex flex-col gap-2.5 rounded-2xl bg-[var(--c-card-bg,var(--color-sky))] p-4 md:gap-3.5 md:rounded-[1.25rem] md:p-7 max-md:items-center max-md:text-center">
                <span class="icon-tile size-14 rounded-2xl bg-[var(--c-tile-bg,var(--color-white))] md:size-21 md:rounded-[1.625rem]">
                    <x-card-icon :item="$item" class="size-9 md:size-14" />
                </span>
                <h3 class="m-0 text-base font-bold text-[var(--c-title,var(--color-ink))] md:text-lg">{!! $item['title'] ?? '' !!}</h3>
                <p class="m-0 text-[0.9375rem] text-[var(--c-text,var(--color-ink-soft))] max-md:text-sm">{!! $item['text'] ?? '' !!}</p>
            </div>
        @endforeach
    </div>
</section>
