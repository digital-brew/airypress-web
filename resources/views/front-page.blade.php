@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if ($featuredPost)
    <section class="mb-16">
      <article class="bg-black text-white overflow-hidden p-8">
        @if ($featuredPost->hasThumbnail())
          <figure class="aspect-video mb-6">
            <img src="{{ $featuredPost->thumbnail('large') }}" alt="{{ $featuredPost->title() }}" class="w-full h-full object-cover">
          </figure>
        @endif

        <h2 class="text-3xl font-bold mb-4">
        <a href="{{ $featuredPost->permalink() }}" class="hover:text-white transition-colors">
            {{ $featuredPost->title() }}
        </a>
        </h2>
        <p class="text-white text-lg mb-6">{{ $featuredPost->excerpt(30) }}</p>
        <a href="{{ $featuredPost->permalink() }}" class="inline-block bg-white text-black px-6 py-3 hover:bg-white transition-colors">
        Read More
        </a>
      </article>
    </section>
  @endif

  @if ($recentPosts->count() > 0)
    <section class="mb-16">
      <header class="mb-8">
        <h3 class="text-2xl font-bold">Recent Posts</h3>
      </header>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($recentPosts as $post)
          <article class="bg-white overflow-hidden border border-black hover:bg-white transition-colors">
            @if ($post->hasThumbnail())
              <figure class="aspect-video">
                <a href="{{ $post->permalink() }}">
                  <img src="{{ $post->thumbnail('medium') }}" alt="{{ $post->title() }}" class="w-full h-full object-cover">
                </a>
              </figure>
            @endif

            <div class="p-6">
              <h4 class="text-xl font-semibold mb-3">
                <a href="{{ $post->permalink() }}" class="hover:text-black transition-colors">
                  {{ $post->title() }}
                </a>
              </h4>
              <p class="text-black mb-4">{{ $post->excerpt(20) }}</p>

              <div class="flex items-center justify-between text-sm text-black">
                <time datetime="{{ $post->post_date->format('Y-m-d') }}" class="font-medium">
                  {{ $post->post_date->format('M j, Y') }}
                </time>

                @if ($post->categories())
                  <div class="flex gap-2">
                    @foreach ($post->categories() as $category)
                      <span class="bg-black text-white px-2 py-1 text-xs">
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
        <h3 class="text-2xl font-bold">Featured Seeds</h3>
        <a href="/seeds/" class="text-black hover:text-black font-medium transition-colors">
          View All Seeds
        </a>
      </header>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($featuredSeeds as $seed)
          <article class="bg-white overflow-hidden border border-black hover:bg-white transition-colors">
            @if ($seed->hasThumbnail())
              <figure class="aspect-square">
                <a href="{{ $seed->permalink() }}">
                  <img src="{{ $seed->thumbnail('large') }}" alt="{{ $seed->title() }}" class="w-full h-full object-cover">
                </a>
              </figure>
            @endif

            <div class="p-4">
              <h4 class="font-semibold mb-2">
                <a href="{{ $seed->permalink() }}" class="hover:text-black transition-colors">
                  {{ $seed->title() }}
                </a>
              </h4>
              <p class="text-black text-sm mb-3">{{ $seed->excerpt(15) }}</p>

              @if ($seed->categories())
                <div class="flex flex-wrap gap-1">
                  @foreach ($seed->categories() as $category)
                    <span class="bg-black text-white px-2 py-1 text-xs">
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

  <aside class="bg-black text-white p-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
      <div>
        <h4 class="text-3xl font-bold text-white mb-2">{{ $totalPosts }}</h4>
        <p class="text-white font-medium">Blog Posts</p>
      </div>
      <div>
        <h4 class="text-3xl font-bold text-white mb-2">{{ $totalSeeds }}</h4>
        <p class="text-white font-medium">Seeds</p>
      </div>
      <div>
        <h4 class="text-3xl font-bold text-white mb-2">{{ $totalCategories }}</h4>
        <p class="text-white font-medium">Categories</p>
      </div>
    </div>
  </aside>
@endsection
