<x-layout>
    <div>
        <form action="/lands" method="get">
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
            <x-td :content="$land->households->count()" />
            <x-td :content="$land->households->reduce(
                function ($carry, $item) {
                    return $carry + $item->pivot->area;
                })" />
            <x-td :content="$land->households->reduce(
                function ($carry, $item) {
                    return $carry + $item->pivot->income;
                })" />
        </tr>
    @endforeach

    </table>


</x-layout>