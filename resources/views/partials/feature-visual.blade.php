{{-- Decorative feature card illustration ($visual: menu, toolbar, columns, handover). Editor copy: resources/js/editor/blocks/features/visuals.jsx --}}
@php
    $grip = '<span class="grid grid-cols-2 gap-[3px] opacity-40"><span class="size-[3px] rounded-full bg-current"></span><span class="size-[3px] rounded-full bg-current"></span><span class="size-[3px] rounded-full bg-current"></span><span class="size-[3px] rounded-full bg-current"></span><span class="size-[3px] rounded-full bg-current"></span><span class="size-[3px] rounded-full bg-current"></span></span>';
@endphp

<div class="w-full text-left" aria-hidden="true">
    @switch($visual)
        @case('toolbar')
            <div class="flex flex-col gap-2.5 text-[15px] text-white">
                <span class="pb-1 text-xs text-ice/80">Toolbar items</span>
                @foreach (['Site name' => true, 'Account' => true, 'SEO plugin badge' => false, 'Cache plugin badge' => false] as $label => $on)
                    <span @class(['flex items-center justify-between gap-3 rounded-xl bg-white/10 px-4 py-3.5', 'text-white/60' => ! $on])>
                        {{ $label }}
                        <span @class(['flex h-6 w-11 flex-none rounded-full p-1', 'justify-end bg-sun' => $on, 'bg-white/20' => ! $on])>
                            <span @class(['size-4 rounded-full', 'bg-ink' => $on, 'bg-white' => ! $on])></span>
                        </span>
                    </span>
                @endforeach
            </div>
            @break

        @case('columns')
            <div class="flex flex-col gap-4 text-sm text-ink">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="rounded-full bg-mist px-3.5 py-2">Image</span>
                    <span class="rounded-full bg-mist px-3.5 py-2">Title</span>
                    <span class="-rotate-3 rounded-full bg-brand px-3.5 py-2 text-white shadow-[0_10px_20px_-10px_rgba(6,47,63,0.6)]">ACF: Season ↓</span>
                    <span class="rounded-full bg-mist px-3.5 py-2">Modified</span>
                    <span class="rounded-full border border-dashed border-ink-soft/40 px-3.5 py-2 text-ink-soft line-through">Tags</span>
                </div>
                @foreach (range(1, 3) as $row)
                    <span class="flex items-center gap-3">
                        <span class="size-10 flex-none rounded-xl bg-mist"></span>
                        <span class="h-2 flex-[2] rounded-full bg-mist"></span>
                        <span class="h-2 flex-1 rounded-full bg-frost"></span>
                        <span class="h-2 flex-1 rounded-full bg-mist"></span>
                    </span>
                @endforeach
            </div>
            @break

        @case('handover')
            <div class="flex flex-wrap items-center justify-center gap-5 text-ink">
                <div class="flex w-[min(280px,100%)] flex-col gap-3 rounded-2xl bg-white p-5 shadow-[0_24px_40px_-24px_rgba(6,47,63,0.6)]">
                    <span class="mx-auto mb-1 size-10 rounded-xl bg-sun"></span>
                    <span class="h-9 rounded-lg border border-line"></span>
                    <span class="h-9 rounded-lg border border-line"></span>
                    <span class="rounded-full bg-ink py-2.5 text-center text-sm font-bold text-white">Log in</span>
                    <span class="text-center text-xs text-ink-soft">Need an account? Email us</span>
                </div>
                <div class="flex flex-col items-start gap-2.5 text-sm font-bold">
                    <span class="rounded-full bg-white px-4 py-2.5">Maintenance page</span>
                    <span class="rounded-full bg-white px-4 py-2.5">Open Graph cards</span>
                    <span class="rounded-full bg-sun px-4 py-2.5">GA4 dashboard</span>
                </div>
            </div>
            @break

        @default
            <div class="flex flex-col gap-2.5 text-[15px] text-ink">
                @foreach (['Dashboard', 'Orders'] as $label)
                    <span class="flex items-center gap-3 rounded-xl bg-mist px-4 py-3">{!! $grip !!}{{ $label }}</span>
                @endforeach
                <span class="ml-10 flex -rotate-2 items-center gap-3 rounded-xl bg-brand px-4 py-3 text-white shadow-[0_16px_28px_-14px_rgba(6,47,63,0.6)]">
                    {!! $grip !!}Refunds
                    <span class="ml-auto rounded-full bg-white/20 px-2.5 py-1 text-xs">Level 2</span>
                </span>
                <span class="flex items-center gap-3 rounded-xl bg-mist px-4 py-3">
                    {!! $grip !!}Products
                    <span class="ml-auto rounded-full bg-white px-2.5 py-1 text-xs">Hidden for Editors</span>
                </span>
            </div>
    @endswitch
</div>
