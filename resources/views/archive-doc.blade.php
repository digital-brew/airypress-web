@extends('layouts.app')

@section('full-width', true)

@section('content')
    <x-docs-layout>
        <h1 class="headline text-[clamp(40px,5vw,60px)]">{{ $docsIndex['title'] }}</h1>

        <div class="docs-prose mt-8">
            {!! do_blocks($docsIndex['content']) !!}
        </div>
    </x-docs-layout>
@endsection
