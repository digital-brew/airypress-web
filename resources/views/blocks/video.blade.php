@php($embed = $embedUrl ? $GLOBALS['wp_embed']->shortcode([], $embedUrl) : '')

<section {!! $wrapper() !!}>
    <div class="flex min-h-[656px] items-center justify-center bg-[var(--c-bg,var(--color-ink))] px-6 py-12">
        @if ($embed)
            <div class="aspect-video w-full max-w-[1100px] overflow-hidden rounded-[32px] [&_iframe]:size-full">
                {!! $embed !!}
            </div>
        @elseif ($videoUrl)
            <div x-data="{ playing: false }" class="relative w-full max-w-[1100px] overflow-hidden rounded-[32px]">
                <video
                    x-ref="video"
                    src="{{ esc_url($videoUrl) }}"
                    @if ($posterUrl) poster="{{ esc_url($posterUrl) }}" @endif
                    preload="metadata"
                    playsinline
                    class="block aspect-video w-full bg-ink object-cover"
                    :controls="playing"
                    @play="playing = true"
                ></video>

                <button type="button" x-show="! playing" @click="$refs.video.play()" class="absolute inset-0 flex cursor-pointer flex-col items-center justify-center gap-4 text-[var(--c-caption,var(--color-frost))]">
                    @include('partials.play-button')
                    <span class="text-[15px]">{!! $caption ?: __('Play video', 'radicle') !!}</span>
                </button>
            </div>
        @else
            <div class="flex flex-col items-center gap-4 text-center text-[var(--c-caption,var(--color-frost))]">
                @include('partials.play-button')
                @if ($caption)
                    <span class="text-[15px]">{!! $caption !!}</span>
                @endif
            </div>
        @endif
    </div>
</section>
