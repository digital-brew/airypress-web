@extends('layouts.app')

@section('full-width', true)

@section('content')
    @while(have_posts()) @php(the_post())
        @php(the_content())
    @endwhile
@endsection
