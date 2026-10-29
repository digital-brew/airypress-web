@php
    $embed = $embedUrl ? $GLOBALS['wp_embed']->shortcode([], $embedUrl) : '';
    $label = $caption ?: __('Watch the demo', 'radicle');
    $modal = $videoUrl || $video4kUrl;
    $overlay = max(0, min(100, (int) $overlayOpacity)) / 100;
    $length = $videoId ? (wp_get_attachment_metadata($videoId)['length_formatted'] ?? '') : '';

    // Version the uploads by file time, so replacing a file in place reaches browsers that cached it.
    $versioned = static function ($id, $url) {
        $file = $id && $url ? get_attached_file((int) $id) : '';

        return $file && file_exists($file) ? add_query_arg('v', filemtime($file), $url) : $url;
    };
    $backgroundVideoUrl = $versioned($backgroundVideoId, $backgroundVideoUrl);
    $videoUrl = $versioned($videoId, $videoUrl);
    $video4kUrl = $versioned($video4kId, $video4kUrl);
    $posterUrl = $versioned($posterId, $posterUrl);
    $sources = ['hd' => esc_url($videoUrl), 'uhd' => esc_url($video4kUrl)];

    // Chapter times are written as m:ss (or plain seconds).
    $seconds = static fn ($time) => array_reduce(explode(':', (string) $time), fn ($total, $part) => $total * 60 + (int) $part, 0);
@endphp

<section {!! $wrapper('bg-[var(--c-bg,var(--color-ink))] px-6 py-28') !!}>
    <div x-data="videoSection({{ wp_json_encode($sources) }})" class="shell flex flex-col gap-14">
        @if ($eyebrow || $heading || $text)
            <div class="flex flex-wrap items-end justify-between gap-x-10 gap-y-4">
                <div class="flex min-w-0 flex-[1_1_35rem] flex-col items-start gap-5">
                    @if ($eyebrow)
                        <span class="rounded-full bg-[var(--c-eyebrow-bg,rgb(255_255_255/0.1))] px-4 py-2 text-[0.9375rem] font-bold text-[var(--c-eyebrow,var(--color-sun))]">{!! $eyebrow !!}</span>
                    @endif
                    @if ($heading)
                        <h2 class="headline text-[clamp(2.75rem,6vw,5rem)] leading-[0.95] tracking-[-0.04em] text-[var(--c-heading,var(--color-white))]">{!! $heading !!}</h2>
                    @endif
                </div>
                @if ($text)
                    <p class="m-0 max-w-100 flex-[0_1_25rem] text-lg text-[var(--c-text,var(--color-frost))]">{!! $text !!}</p>
                @endif
            </div>
        @endif

        {{-- The frame: the muted loop under an overlay, with the play button on top --}}
        <div class="rounded-[2.25rem] bg-[var(--c-frame,rgb(255_255_255/0.08))] p-3.5">
            <div class="relative isolate flex aspect-video items-center justify-center overflow-hidden rounded-3xl bg-[var(--c-overlay,var(--color-ink))]">
                @if ($modal)
                    {{-- The poster is an <img> rather than the video's poster attribute, which Safari letterboxes --}}
                    @if ($posterUrl)
                        <img src="{{ esc_url($posterUrl) }}" alt="" class="absolute inset-0 -z-10 size-full object-cover">
                    @endif
                    @if ($backgroundVideoUrl)
                        <video
                            data-background
                            src="{{ esc_url($backgroundVideoUrl) }}"
                            muted
                            loop
                            playsinline
                            preload="metadata"
                            aria-hidden="true"
                            tabindex="-1"
                            class="absolute inset-0 -z-10 size-full object-cover"
                        ></video>
                    @endif
                    <span class="absolute inset-0 -z-10 bg-[var(--c-overlay,var(--color-ink))]" style="opacity: {{ $overlay }}" aria-hidden="true"></span>

                    <button type="button" @click="open()" class="group flex cursor-pointer flex-col items-center">
                        @include('partials.play-button')
                        <span class="mt-3 md:mt-8 rounded-full bg-[var(--c-label-bg,var(--color-ink))] px-3 py-1.5 text-sm md:px-5 md:py-2.5 md:text-lg font-bold text-[var(--c-label,var(--color-white))]">
                            {!! $label !!}@if ($length) <span aria-hidden="true">·</span> {{ $length }}@endif
                        </span>
                    </button>
                @elseif ($embed)
                    <div class="size-full [&_iframe]:size-full">{!! $embed !!}</div>
                @else
                    @include('partials.play-button')
                @endif
            </div>
        </div>

        @if ($chapters)
            <ol class="m-0 flex list-none flex-wrap justify-center gap-3 p-0">
                @foreach ($chapters as $index => $chapter)
                    <li>
                        <button
                            type="button"
                            @if ($modal) @click="open({{ $seconds($chapter['time'] ?? 0) }})" @endif
                            class="pill min-h-10 cursor-pointer gap-2 bg-[var(--c-chapter-bg,rgb(255_255_255/0.08))] py-1.5 pr-4 pl-2 text-base font-medium text-[var(--c-chapter,var(--color-white))] hover:shadow-none md:min-h-13 md:gap-3 md:py-2 md:pr-5 md:pl-2.5 md:text-lg"
                        >
                            <span class="icon-tile size-6 rounded-full bg-[var(--c-number-bg,var(--color-brand))] text-xs font-bold text-[var(--c-number,var(--color-white))] md:size-7 md:text-sm">{{ $index + 1 }}</span>
                            {!! $chapter['title'] ?? '' !!}
                        </button>
                    </li>
                @endforeach
            </ol>
        @endif

        @if ($modal)
            <dialog
                x-ref="dialog"
                @close="closed()"
                @click.self="$refs.dialog.close()"
                aria-label="{{ wp_strip_all_tags($label) }}"
                class="m-auto w-[min(92vw,calc(80vh*16/9))] max-w-none overflow-visible bg-transparent p-0 text-white backdrop:bg-ink/90 backdrop:backdrop-blur-sm"
            >
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-end gap-2">
                        @if ($videoUrl && $video4kUrl)
                            <div class="flex rounded-full bg-white/10 p-1 text-sm font-bold" role="group" aria-label="{{ __('Video quality', 'radicle') }}">
                                @foreach (['hd' => '1080p', 'uhd' => '4K'] as $quality => $name)
                                    <button
                                        type="button"
                                        @click="use('{{ $quality }}')"
                                        :aria-pressed="quality === '{{ $quality }}'"
                                        :class="quality === '{{ $quality }}' ? 'bg-white text-ink' : 'text-white hover:bg-white/10'"
                                        class="cursor-pointer rounded-full px-3.5 py-1.5 transition-colors"
                                    >{{ $name }}</button>
                                @endforeach
                            </div>
                        @endif
                        <button type="button" @click="$refs.dialog.close()" class="icon-tile size-10 cursor-pointer rounded-full bg-white/10 text-white transition-colors hover:bg-white/20" aria-label="{{ __('Close video', 'radicle') }}">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" /></svg>
                        </button>
                    </div>
                    <video
                        x-ref="video"
                        @if ($posterUrl) poster="{{ esc_url($posterUrl) }}" @endif
                        controls
                        playsinline
                        preload="none"
                        class="block aspect-video w-full rounded-[1.25rem] bg-black"
                    ></video>
                </div>
            </dialog>
        @endif
    </div>
</section>
