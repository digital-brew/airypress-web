@props([
    'type' => null,
    'message' => null,
])

@php($class = match ($type) {
    'success' => 'bg-sky',
    'caution' => 'bg-sky',
    'warning' => 'bg-sky',
    default => 'bg-sky',
})

<div {{ $attributes->merge(['class' => "px-2 py-1 {$class}"]) }}>
    {!! $message ?? $slot !!}
</div>
