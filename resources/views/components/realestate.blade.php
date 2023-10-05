<x-layout>
    <div>
        <form action="/realestates" method="get">
            <x-select  label='locations' name='locations' :collection="$locationNames"/>
            <x-btn-submit />
        </form>
    </div>
 
    <table class="container my-10">
        <tr class="bg-gray-300">
            <x-th content="Real Estate TR" />
            <x-th content="Real Estate EN" />
            <x-th content="Total people" />
            <x-th content="Total quantity" />
            <x-th content="Total income" />
        </tr>
    @foreach ($realEstates as $realEstate) 
        <tr class="odd:bg-gray-100">
            <x-td :content="$realEstate->name_tr" />
            <x-td :content="$realEstate->name_en" />
            <x-td :content="$realEstate->households->where('location_name_id', request('locations'))->count()" />
            <x-td :content="$realEstate->households->where('location_name_id', request('locations'))->reduce(function ($carry, $item) {return $carry + $item->pivot->quantity;})" />
            <x-td :content="$realEstate->households->where('location_name_id', request('locations'))->reduce(function ($carry, $item) {return $carry + $item->pivot->income;})" />
        </tr>
    @endforeach

    </table>


</x-layout>