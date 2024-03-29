<x-layout>
    <div>
        <form action="/occupations" method="get">
            <x-location_box :collection="$locationNames"/>
            <x-box title="Filter by Household Member" label="member_type" :collection="$memberTypes" />
            <x-box title="Filter by Real Estate" label='real_estates' :collection="$realEstates"/>
            <x-box title="Filter by Land" label='lands' :collection="$lands"/>
            <x-btn-submit />
        </form>
    </div>
    <table class="container my-10">
        <tr class="bg-gray-300">
            <x-th content="Occupation TR" />
            <x-th content="Occupation EN" />
            <x-th content="Total people" />
            <x-th content="Total income" />
        </tr>
    @foreach ($occupations as $occupation) 
        <tr class="odd:bg-gray-100">
            <x-td :content="$occupation->name_tr" />
            <x-td :content="$occupation->name_en" />
            <x-td :content="$occupation->households->count()" />
            <x-td :content="$occupation->households->reduce(function ($carry, $item) {
                return $carry + $item->pivot->income;
                })" />
        </tr>
    @endforeach
        <tr class="odd:bg-gray-100">
            <x-td content="Total" colspan="2"/>
            <x-td content="Total" />
            <x-td content="Total" />
        </tr>
    </table>


</x-layout>