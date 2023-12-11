<x-layout>
    <div>
        <form action="/taxes" method="get">
            <x-location_box :collection="$locationNames"/>
            <x-btn-submit />
        </form>
    </div>
 
    <table class="container my-10">
        <tr class="bg-gray-300">
            <x-th content="Tax TR" />
            <x-th content="Tax EN" />
            <x-th content="Total people" />
            <x-th content="Total amount" />
        </tr>
    @foreach ($taxes as $tax) 
        <tr class="odd:bg-gray-100">
            <x-td :content="$tax->name_tr" />
            <x-td :content="$tax->name_en" />
            <x-td :content="$tax->households->count()" />
            <x-td :content="$tax->households->reduce(function ($carry, $item) {
                return $carry + $item->pivot->amount;
                })" />
        </tr>
    @endforeach
    </table>


</x-layout>