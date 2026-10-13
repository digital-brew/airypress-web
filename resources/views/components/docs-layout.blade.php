{{-- Docs shell: sidebar navigation + content. Used by the docs archive, single docs and the Changelog page. --}}
<div class="gutter pt-10 pb-24 md:pt-16">
    <div class="shell grid gap-8 lg:grid-cols-[250px_minmax(0,1fr)] lg:gap-16">
        <aside class="lg:sticky lg:top-[calc(var(--header-height)+var(--sticky-offset)+48px)] lg:max-h-[calc(100vh-var(--header-height)-var(--sticky-offset)-72px)] lg:self-start lg:overflow-y-auto">
            {{-- Open by default (and without JavaScript); collapsed on small screens so the content comes first --}}
            <details class="group rounded-3xl bg-sky p-2 lg:bg-transparent lg:p-0" open x-data x-init="if (! matchMedia('(min-width: 64rem)').matches) $el.open = false">
                <summary class="flex cursor-pointer list-none items-center justify-between rounded-2xl px-4 py-3 font-bold lg:hidden [&::-webkit-details-marker]:hidden">
                    {{ __('Browse the docs', 'radicle') }}
                    <svg class="size-5 transition-transform group-open:-rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6" /></svg>
                </summary>
                <nav aria-label="{{ __('Documentation', 'radicle') }}" class="flex flex-col gap-0.5 p-2 lg:p-0">
                    <a href="{{ $docsArchiveUrl }}" @class(['rounded-xl px-3 py-2 text-[15px] font-bold no-underline hover:bg-sky hover:text-ink', 'bg-sky text-ink' => is_post_type_archive('doc'), 'text-ink' => ! is_post_type_archive('doc')])>
                        {{ __('Overview', 'radicle') }}
                    </a>
                    @foreach ($docsNavigation as $item)
                        <a href="{{ $item['url'] }}" @if ($item['active']) aria-current="page" @endif class="rounded-xl px-3 py-2 text-[15px] text-ink-soft no-underline hover:bg-sky hover:text-ink aria-[current=page]:bg-sky aria-[current=page]:font-semibold aria-[current=page]:text-ink">
                            {!! $item['title'] !!}
                        </a>
                    @endforeach
                </nav>
            </details>
        </aside>

        <article class="min-w-0 max-w-[780px]">
            {{ $slot }}
        </article>
    </div>
</div>
