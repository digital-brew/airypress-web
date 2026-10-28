{{-- Decorative wp-admin illustration shown when the hero has no image. Editor copy: resources/js/editor/blocks/hero/mockup.jsx --}}
<div class="flex min-h-[clamp(360px,48vw,630px)] gap-3 rounded-[1.25rem] bg-mist p-3 text-left text-ink" aria-hidden="true">
    <div class="flex w-[220px] flex-none flex-col gap-1 py-3 text-[15px] text-ink-soft max-md:hidden">
        <div class="flex items-center gap-2.5 px-7 pb-5 font-bold text-ink">
            <span class="size-7 rounded-lg bg-brand"></span>Client Co.
        </div>
        <span class="flex items-center gap-3 rounded-2xl bg-white px-4 py-3 font-bold text-ink"><span class="size-1.5 rounded-full bg-brand"></span>Dashboard</span>
        @foreach (['Orders', 'Products', 'Pages', 'Customers'] as $label)
            <span class="flex items-center gap-3 px-4 py-3"><span class="size-1.5 rounded-full bg-frost"></span>{{ $label }}</span>
        @endforeach
        <span class="mt-auto flex items-center gap-3 px-4 py-3"><span class="size-1.5 rounded-full bg-frost"></span>Settings</span>
    </div>

    <div class="flex min-w-0 flex-1 flex-col gap-4 rounded-3xl bg-white p-[clamp(14px,2vw,26px)]">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <span class="font-display text-[clamp(20px,2vw,26px)] font-extrabold tracking-[-0.02em]">Dashboard</span>
            <span class="flex gap-2 text-sm font-bold">
                <span class="rounded-full border border-line px-4 py-2.5 font-medium max-sm:hidden">View site</span>
                <span class="rounded-full bg-brand px-4 py-2.5 text-white">Add product</span>
            </span>
        </div>

        <div class="grid flex-1 grid-cols-[repeat(auto-fit,minmax(min(260px,100%),1fr))] gap-4 md:grid-cols-[1.7fr_1fr]">
            <div class="flex flex-col gap-4 rounded-2xl bg-mist p-5">
                <span class="flex justify-between gap-2 text-sm font-bold">Site analytics <span class="text-xs font-medium text-ink-soft">GA4 · 28 days</span></span>
                <span class="flex h-[clamp(90px,10vw,140px)] items-end gap-2">
                    @foreach ([31, 50, 41, 59, 54, 73, 67, 85] as $height)
                        <span class="flex-1 rounded-lg bg-frost" style="height: {{ $height }}%"></span>
                    @endforeach
                    <span class="h-full flex-1 rounded-lg bg-brand"></span>
                </span>
            </div>

            <div class="flex flex-col gap-3 rounded-2xl bg-ink p-5 text-white">
                <span class="text-sm font-bold">Online now</span>
                <span class="flex items-center gap-2"><span class="size-2.5 rounded-full bg-sun"></span><span class="h-2 w-3/5 rounded-full bg-white/25"></span></span>
                <span class="h-2 w-1/2 rounded-full bg-white/25"></span>
                <span class="h-2 w-2/5 rounded-full bg-white/25"></span>
                <span class="mt-auto self-start rounded-full bg-white px-3.5 py-2 text-xs font-bold text-ink">Top pages</span>
            </div>

            <div class="flex flex-col gap-4 rounded-2xl border border-line p-5 max-sm:hidden">
                <span class="text-sm font-bold">Recent orders</span>
                @foreach (['Paid', 'Pending', 'Paid'] as $status)
                    <span class="flex items-center gap-3">
                        <span class="size-9 flex-none rounded-xl bg-mist"></span>
                        <span class="h-2 flex-1 rounded-full bg-mist"></span>
                        <span @class([
                            'rounded-full px-2.5 py-1 text-[11px] font-bold',
                            'bg-sky text-brand-dark' => $status === 'Paid',
                            'bg-sun/40 text-ink' => $status !== 'Paid',
                        ])>{{ $status }}</span>
                    </span>
                @endforeach
            </div>

            <div class="flex flex-col gap-3 rounded-2xl bg-sun p-5 max-sm:hidden">
                <span class="text-sm font-bold">Need a change?</span>
                <span class="h-2 w-4/5 rounded-full bg-ink/15"></span>
                <span class="h-2 w-3/5 rounded-full bg-ink/15"></span>
                <span class="mt-auto self-start rounded-full bg-ink px-3.5 py-2 text-xs font-bold text-white">Email your agency</span>
            </div>
        </div>
    </div>
</div>
