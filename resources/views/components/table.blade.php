@props([
    'rows' => [],
    'columns' => [],
])

<div class="">
    <table {{ $attributes->merge(['class' => 'w-full text-left my-6']) }}>
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th scope="col" class="p-3 bg-sky border-b border-b-gray-300">{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($row as $column)
                        <td class="p-3 border-b border-b-gray-300">{!! $column !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
