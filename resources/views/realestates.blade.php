<x-layout>
    <div>
        <form action="/realestates" method="get">
            <x-location_box :collection="$locationNames"/>
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
            <x-td :content="$realEstate->households
            ->whereIn('location_name_id', $locationIds)->count()" />
            <x-td :content="$realEstate->households
            ->whereIn('location_name_id', $locationIds)
            ->reduce(function ($carry, $item) {
                return $carry + $item->pivot->quantity;
                })" />
            <x-td :content="$realEstate->households
            ->whereIn('location_name_id', $locationIds)
            ->reduce(function ($carry, $item) {
                return $carry + $item->pivot->income;
                })" />
        </tr>
    @endforeach

    </table>


</x-layout>