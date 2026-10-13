<section {!! $wrapper('bg-[var(--c-bg,transparent)] px-6 pb-24') !!}>
    <div class="shell grid grid-cols-[repeat(auto-fit,minmax(min(260px,100%),1fr))] gap-4">
        @foreach ($items as $item)
            <div class="flex flex-col gap-3.5 rounded-[28px] bg-[var(--c-card-bg,var(--color-sky))] p-7">
                <span class="icon-tile size-[84px] rounded-[26px] bg-[var(--c-tile-bg,var(--color-white))]">
                    <x-card-icon :item="$item" class="size-14" />
                </span>
                <h3 class="m-0 text-lg font-bold text-[var(--c-title,var(--color-ink))]">{!! $item['title'] ?? '' !!}</h3>
                <p class="m-0 text-[15px] text-[var(--c-text,var(--color-ink-soft))]">{!! $item['text'] ?? '' !!}</p>
            </div>
        @endforeach
    </div>
</section>
