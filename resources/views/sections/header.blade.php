<header class="{{ $containerClasses }}">
    <div class="{{ $containerInnerClasses }}">
        <a class="block py-3 text-lg font-bold" href="{{ home_url('/') }}">
            {!! $siteName !!}
        </a>

        @if (has_nav_menu('primary_navigation'))
            <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
                {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
            </nav>
        @endif
    </div>
</header>
