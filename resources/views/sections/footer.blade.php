<footer class="gutter bg-ink pt-[clamp(40px,6vw,80px)] pb-8 text-white">
    <div class="shell flex flex-col gap-14">
        <div class="flex flex-wrap justify-between gap-12">
            <div class="flex max-w-[460px] flex-[1_1_360px] flex-col gap-[18px]">
                @if ($footerTagline)
                    <p class="headline text-[40px]">{{ $footerTagline }}</p>
                @endif

                @if ($newsletter)
                    @include('partials.newsletter', $newsletter)
                @endif
            </div>

            @if ($footerNavigation->isNotEmpty())
                <div class="flex flex-wrap gap-14">
                    @foreach ($footerNavigation->all() as $group)
                        <nav aria-label="{{ wp_strip_all_tags($group->label) }}" class="flex flex-col gap-3 text-[15px]">
                            <span class="font-bold text-sun">{!! $group->label !!}</span>
                            @foreach ($group->children ?: [] as $item)
                                <a href="{{ $item->url }}" @if ($item->target) target="{{ $item->target }}" @endif class="text-white no-underline hover:text-sun">{!! $item->label !!}</a>
                            @endforeach
                        </nav>
                    @endforeach
                </div>
            @endif
        </div>

        @if ($copyright || $legalNote)
            <div class="flex flex-wrap justify-between gap-3 border-t border-white/15 pt-6 text-sm text-frost">
                <span>{{ $copyright }}</span>
                <span>{{ $legalNote }}</span>
            </div>
        @endif
    </div>
</footer>
