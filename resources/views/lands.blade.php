<x-layout>
    <div>
        <form action="/lands" method="get">
            <x-select  label='locations' name='locations' :collection="$locationNames"/>
            <x-btn-submit />
        </form>
    </div>
 
    <table class="container my-10">
        <tr class="bg-gray-300">
            <x-th content="Land TR" />
            <x-th content="Land EN" />
            <x-th content="Total people" />
            <x-th content="Total area" />
            <x-th content="Total income" />
        </tr>
    @foreach ($lands as $land) 
        <tr class="odd:bg-gray-100">
            <x-td :content="$land->name_tr" />
            <x-td :content="$land->name_en" />
            <x-td :content="$land->households->where('location_name_id', request('locations'))->count()" />
            <x-td :content="$land->households->where('location_name_id', request('locations'))->reduce(function ($carry, $item) {return $carry + $item->pivot->area;})" />
            <x-td :content="$land->households->where('location_name_id', request('locations'))->reduce(function ($carry, $item) {return $carry + $item->pivot->income;})" />
        </tr>
    @endforeach

    </table>


</x-layout>