@props(['name' => ''])

@php
    try {
        $svg = $name === '' ? null : svg('airy-' . $name, $attributes->get('class', ''), ['aria-hidden' => 'true']);
    } catch (\BladeUI\Icons\Exceptions\SvgNotFound) {
        $svg = null;
    }
@endphp

{{ $svg }}
