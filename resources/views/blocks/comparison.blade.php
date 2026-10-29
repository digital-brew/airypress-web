<section {!! $wrapper() !!}>
    <div class="bg-[var(--c-bg,var(--color-sky))] px-[clamp(16px,4vw,56px)] py-[clamp(40px,6vw,96px)]">
        <div class="mx-auto flex max-w-[1100px] flex-col gap-10">
            @if ($heading)
                <h2 class="section-title text-center text-[var(--c-heading,var(--color-ink))]">{!! $heading !!}</h2>
            @endif

            @if ($columns)
                <div class="overflow-x-auto rounded-[1.25rem] bg-[var(--c-table-bg,var(--color-white))] p-3">
                    <table class="w-full min-w-[640px] border-separate border-spacing-0 text-base">
                        <thead>
                            <tr>
                                <th class="p-5"><span class="sr-only">{{ __('Feature', 'radicle') }}</span></th>
                                @foreach ($columns as $column)
                                    <th scope="col" @class([
                                        'p-5',
                                        'rounded-t-[22px] bg-[var(--c-highlight-bg,var(--color-brand))] font-display text-xl font-extrabold text-[var(--c-highlight-text,var(--color-white))]' => $loop->first,
                                        'font-bold' => ! $loop->first,
                                    ])>{!! $column !!}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                                @php($lastRow = $loop->last)
                                <tr>
                                    <th scope="row" class="border-t border-[var(--c-line,var(--color-line))] px-5 py-[18px] text-left font-normal text-[var(--c-label-text,var(--color-ink))]">{!! $row['label'] ?? '' !!}</th>
                                    @foreach ($columns as $index => $column)
                                        <td @class([
                                            'px-5 py-[18px] text-center',
                                            'bg-[var(--c-highlight-bg,var(--color-brand))] font-bold text-[var(--c-highlight-text,var(--color-white))]' => $index === 0,
                                            'rounded-b-[22px]' => $index === 0 && $lastRow,
                                            'border-t border-[var(--c-line,var(--color-line))] text-[var(--c-cell-text,var(--color-ink-soft))]' => $index > 0,
                                        ])>{!! $row['values'][$index] ?? '' !!}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if ($chips)
                <ul class="m-0 flex list-none flex-wrap justify-center gap-2 p-0 md:gap-2.5">
                    @foreach ($chips as $chip)
                        <li class="rounded-full bg-[var(--c-chip-bg,var(--color-white))] px-3 py-1.5 text-[0.8125rem] font-medium text-[var(--c-chip-text,var(--color-ink))] md:px-[1.125rem] md:py-2.5 md:text-[0.9375rem]">{!! $chip !!}</li>
                    @endforeach
                </ul>
            @endif

            @if ($tested)
                <div class="flex flex-col items-center gap-x-7 gap-y-3 text-[15px] text-[var(--c-tested-text,var(--color-ink-soft))] sm:flex-row">
                    @if ($testedLabel)
                        <span class="flex-none font-bold text-[var(--c-tested-label,var(--color-ink))]">{!! $testedLabel !!}</span>
                    @endif

                    {{-- Two copies scroll as one seamless loop; the second is hidden from screen readers --}}
                    <div class="marquee w-full min-w-0 flex-1" style="--marquee-duration: {{ max(20, count($tested) * 3) }}s">
                        <div class="marquee-track">
                            @foreach ([false, true] as $copy)
                                <ul class="m-0 flex flex-none list-none gap-x-7 p-0 pr-7" @if ($copy) aria-hidden="true" @endif>
                                    @foreach ($tested as $name)
                                        <li class="whitespace-nowrap">{!! $name !!}</li>
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
