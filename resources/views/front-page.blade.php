@extends('layouts.app')

@section('content')
    @include('partials.page-header')

    @if ($featuredPost)
        <section class="mb-16">
            <article class="p-8 overflow-hidden text-white bg-black">
                @if ($featuredPost->hasThumbnail())
                    <figure class="mb-6 aspect-video">
                        <img src="{{ $featuredPost->thumbnail('large') }}" alt="{{ $featuredPost->title() }}" class="object-cover w-full h-full">
                    </figure>
                @endif

                <x-heading level="h2" size="2xl" class="mb-4">
                    <x-link href="{{ $featuredPost->permalink() }}" variant="unstyled" class="text-white hover:text-white transition-colors">
                        {{ $featuredPost->title() }}
                </x-link>
            </x-heading>
            <p class="mb-6 text-lg text-white">{{ $featuredPost->excerpt(30) }}</p>
            <x-button href="{{ $featuredPost->permalink() }}" variant="inverse">
                Read More
            </x-button>
        </article>
        </section>
    @endif

    @if ($recentPosts->count() > 0)
        <section class="mb-16">
            <header class="mb-8">
                <x-heading level="h3" size="2xl">Recent Posts</x-heading>
            </header>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($recentPosts as $post)
                    <article class="overflow-hidden bg-white border border-black hover:bg-white transition-colors">
                        @if ($post->hasThumbnail())
                            <figure class="aspect-video">
                                <a href="{{ $post->permalink() }}">
                                    <img src="{{ $post->thumbnail('medium') }}" alt="{{ $post->title() }}" class="object-cover w-full h-full">
                                </a>
                            </figure>
                        @endif

                        <div class="p-6">
                            <x-heading level="h4" size="xl" class="mb-3">
                                <x-link href="{{ $post->permalink() }}" variant="unstyled" class="hover:text-black transition-colors">
                                    {{ $post->title() }}
                                </x-link>
                            </x-heading>
                            <p class="mb-4 text-black">{{ $post->excerpt(20) }}</p>
                            <div class="flex items-center justify-between text-sm text-black">
                                <time datetime="{{ $post->post_date->format('Y-m-d') }}" class="font-medium">
                                    {{ $post->post_date->format('M j, Y') }}
                                </time>

                                @if ($post->categories())
                                    <div class="flex gap-2">
                                        @foreach ($post->categories() as $category)
                                            <span class="px-2 py-1 text-xs text-white bg-black">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    @if ($featuredSeeds->count() > 0)
        <section class="mb-16">
            <header class="flex items-center justify-between mb-8">
                <x-heading level="h3" size="2xl">Featured Seeds</x-heading>
                <x-link href="/seeds/" weight="medium">
                    View All Seeds
                </x-link>
            </header>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($featuredSeeds as $seed)
                    <article class="overflow-hidden bg-white border border-black hover:bg-white transition-colors">
                        @if ($seed->hasThumbnail())
                            <figure class="aspect-square">
                                <a href="{{ $seed->permalink() }}">
                                    <img src="{{ $seed->thumbnail('large') }}" alt="{{ $seed->title() }}" class="object-cover w-full h-full">
                                </a>
                            </figure>
                        @endif

                        <div class="p-4">
                            <x-heading level="h4" size="sm" class="mb-2">
                                <x-link href="{{ $seed->permalink() }}" variant="unstyled" class="hover:text-black transition-colors">
                                    {{ $seed->title() }}
                                </x-link>
                            </x-heading>
                            <p class="mb-3 text-sm text-black">{{ $seed->excerpt(15) }}</p>

                            @if ($seed->categories())
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($seed->categories() as $category)
                                        <span class="px-2 py-1 text-xs text-white bg-black">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <aside class="p-8 text-white bg-black">
        <div class="text-center grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <x-heading level="h4" size="3xl" color="white" class="mb-2">{{ $totalPosts }}</x-heading>
                <p class="font-medium text-white">Blog Posts</p>
            </div>
            <div>
                <x-heading level="h4" size="3xl" color="white" class="mb-2">{{ $totalSeeds }}</x-heading>
                    <p class="font-medium text-white">Seeds</p>
                </div>
            <div>
                <x-heading level="h4" size="3xl" color="white" class="mb-2">{{ $totalCategories }}</x-heading>
                <p class="font-medium text-white">Categories</p>
            </div>
        </div>
  </aside>
@endsection
