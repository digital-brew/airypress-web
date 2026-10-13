@extends('layouts.app')

@section('full-width', true)

@section('content')
    @while (have_posts()) @php(the_post())
        <x-docs-layout>
            @include('partials.docs-article')
        </x-docs-layout>
    @endwhile
@endsection
