<x-layout>
    @include('_success')
    <div>
        <form action="/households" method="get">
            <x-occupation_box :collection="$occupations" />
            <x-location_box :collection="$locationNames" />
            <x-box title="Filter by Household Member" label="member_type" :collection="$memberTypes" />
            <x-box title="Filter by Tax" label='taxes' :collection="$taxes"/>
            <x-box title="Filter by Real Estate" label='real_estates' :collection="$realEstates"/>
            <x-box title="Filter by Land" label='lands' :collection="$lands"/>
            <x-box title="Filter by Livestock" label='livestocks' :collection="$livestocks"/>
            <x-input name="notes" label="Search Notes" placeholder="type the text you're looking for..." />
            <x-input name="forname" label="Search Fornames" placeholder="type the text you're looking for..." />
            <x-input name="surname" label="Search Surnames" placeholder="type the text you're looking for..." />
            <x-btn-submit />
        </form>
    </div>
    
    <table class="container my-10 text-center">
        <tr class="bg-gray-300">
            <x-th content="Total Households" />
            <x-th content="Occupation Income" />
            <x-th content="Land Income" />
            <x-th content="Livestock Income" />
            <x-th content="Real Estate Income" />
            <x-th content="Total Income" />
            <x-th content="Taxes" />
        </tr>
        <tr class="odd:bg-gray-100">
            <x-td :content="number_format($count)" />
            <x-td :content="number_format($sums['occupation'])" />
            <x-td :content="number_format($sums['land'])" />
            <x-td :content="number_format($sums['livestock'])" />
            <x-td :content="number_format($sums['realEstate'])" />
            <x-td :content="number_format($sums['occupation']+$sums['land']+$sums['livestock']+$sums['realEstate'])" />
            <x-td :content="number_format($sums['tax'])" />
        </tr>
    </table>

    <table class="container my-10">
        <tr class="bg-gray-300">
            <x-th content="Location Name" />
            <x-th content="Location Type" />
            <x-th content="House No" />
            <x-th content="Name" />
            <x-th content="Father Name" />
            <x-th content="Position in Household" />
            <x-th content="Archive Code" />
            <x-th content="Page" />
        </tr>
    @foreach ($households as $household)
        <tr class="odd:bg-gray-100">
            <td class="border p-3">
                <a href={{ strpos(url()->full(), "?") ? '/household/' . $household->id . substr(url()->full(), strpos(url()->full(), "?")) : '/household/' . $household->id}}> 
                {{ $household->locationName->name_tr }}
                </a>
            </td>
            <x-td :content="$household->locationName->locationType->name_en" />
            <x-td :content="$household->number" />
            <x-td :content="$household->forname" />
            <x-td :content="$household->surname" />
            <x-td :content="$household->memberType->name_en" />
            <x-td :content="$household->archive_code" />
            <x-td :content="$household->page" />
        </tr>
    @endforeach
    </table>
    <div class="container mt-10">
        {{ $households->links()}}
    </div>
</x-layout>