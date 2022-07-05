<x-layout>
        <ul>
        @foreach ($places as $index => $place)
            <li><b>{{ $index + 1 }}</b> {{ $place->name }} : {{ $place->locationType->name_en }} : {{ $place->households_count }}</li>
        @endforeach
        </ul>
</x-layout>