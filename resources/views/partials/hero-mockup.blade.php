{{-- Decorative wp-admin illustration shown when the hero has no image --}}
<div class="rounded-[32px] bg-white p-3 shadow-[0_40px_80px_-30px_rgba(6,47,63,0.55)]" aria-hidden="true">
    <div class="flex min-h-[380px] gap-2.5 rounded-3xl bg-mist p-2.5 text-ink">
        <div class="flex w-[150px] flex-none flex-col gap-1 px-1 py-2 text-[13px] text-ink-soft max-sm:hidden">
            <div class="flex items-center gap-2 px-2 pt-1 pb-3.5 font-bold text-ink">
                <span class="size-5 rounded-[7px] bg-brand"></span>Client Co.
            </div>
            <span class="rounded-xl bg-white px-3 py-2 font-bold text-ink">Dashboard</span>
            @foreach (['Orders', 'Products', 'Pages', 'Customers'] as $label)
                <span class="px-3 py-2">{{ $label }}</span>
            @endforeach
        </div>

        <div class="flex min-w-0 flex-1 flex-col gap-3.5 rounded-[18px] bg-white p-[18px]">
            <div class="flex items-center justify-between gap-2">
                <span class="text-base font-bold">Dashboard</span>
                <span class="rounded-full bg-brand px-3.5 py-1.5 text-xs font-bold text-white">Add product</span>
            </div>

            <div class="flex flex-col gap-2.5 rounded-2xl bg-mist p-3.5">
                <span class="text-xs font-medium text-ink-soft">Site analytics</span>
                <div class="flex h-[90px] items-end gap-1.5">
                    @foreach ([35, 50, 42, 66, 58] as $height)
                        <span class="flex-1 rounded-lg bg-frost" style="height: {{ $height }}%"></span>
                    @endforeach
                    <span class="h-[90%] flex-1 rounded-lg bg-brand"></span>
                </div>
            </div>

            <div class="grid flex-1 grid-cols-2 gap-2.5">
                <div class="rounded-2xl border border-line"></div>
                <div class="rounded-2xl border border-line"></div>
            </div>
        </div>
    </div>
</div>
