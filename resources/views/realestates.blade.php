<x-layout>
    <div>
        <form action="/realestates" method="get">
            <x-occupation_box :collection="$occupations" />
            <x-location_box :collection="$locationNames"/>
            <x-box title="Filter by Household Member" label="member_type" :collection="$memberTypes" />
            <x-input name="description" label="Search By Description" placeholder="type the text you're looking for..." />
            <x-input name="location" label="Search By Location" placeholder="type the text you're looking for..." />
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
            <x-td :content="$realEstate->households->count()" />
            <x-td :content="$realEstate->households->reduce(function ($carry, $item) {
                return $carry + $item->pivot->quantity;
                })" />
            <x-td :content="$realEstate->households->reduce(function ($carry, $item) {
                return $carry + $item->pivot->income;
                })" />
        </tr>
    @endforeach

    </table>


</x-layout>