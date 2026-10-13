<a href="{{ get_post_type_archive_link('doc') }}" class="text-sm font-bold text-brand no-underline hover:text-brand-dark">{{ __('Docs', 'radicle') }}</a>
<h1 class="headline mt-2 text-[clamp(40px,5vw,60px)]">{!! get_the_title() !!}</h1>
<p class="mt-3 mb-0 text-sm text-ink-soft">
    {{ sprintf(__('Updated %s', 'radicle'), get_the_modified_date()) }}
</p>

<div class="docs-prose mt-8">
    @php(the_content())
</div>

@if (! empty($previousDoc) || ! empty($nextDoc))
    <nav aria-label="{{ __('More docs', 'radicle') }}" class="mt-16 grid gap-3 border-t border-line pt-8 sm:grid-cols-2">
        @if (! empty($previousDoc))
            <a href="{{ $previousDoc['url'] }}" class="group rounded-3xl bg-sky p-5 text-ink no-underline hover:text-ink">
                <span class="text-sm text-ink-soft">← {{ __('Previous', 'radicle') }}</span>
                <span class="mt-1 block font-bold group-hover:text-brand">{!! $previousDoc['title'] !!}</span>
            </a>
        @endif
        @if (! empty($nextDoc))
            <a href="{{ $nextDoc['url'] }}" class="group rounded-3xl bg-sky p-5 text-right text-ink no-underline hover:text-ink sm:col-start-2">
                <span class="text-sm text-ink-soft">{{ __('Next', 'radicle') }} →</span>
                <span class="mt-1 block font-bold group-hover:text-brand">{!! $nextDoc['title'] !!}</span>
            </a>
        @endif
    </nav>
@endif
