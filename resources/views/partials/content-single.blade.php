<article @php(post_class('h-entry'))>
    <header>
        <x-heading level="h1" size="3xl" class="mb-6 p-name">
            {!! $title !!}
        </x-heading>

        @include('partials.entry-meta')
    </header>

    <div class="mb-8 e-content space-y-4">
        @php(the_content())
    </div>

    @if ($pagination())
        <footer>
            <nav class="page-nav" aria-label="Page">
                {!! $pagination !!}
            </nav>
        </footer>
    @endif

    @php(comments_template())
</article>
