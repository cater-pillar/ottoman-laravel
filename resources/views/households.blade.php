<x-layout>
    @include('_success')
    <div>

        <x-filter_actives :request="$request" />
        <form action="/households" method="get">
            <div x-data="{open:false, filter: null, search: [], 
                    tempData: {
                        name: '',
                        logic: '',
                        input: '',
                        refKeys: []
                    }}">
                <x-filter_apply />
                <div class="relative inline-block">
                    <div class="inline-block border p-2 bg-gray-100 mb-3 select-none" 
                         x-on:click="open = ! open; filter = null; tempData.refKeys = []; tempData.input= null">
                         add filter
                    </div>
                    <div x-cloak x-show="open" 
                        class="border bg-gray-100 text-gray-500 rounded absolute top-11 left-0 w-80" >
                        <x-filter_list />
                        <x-filter_set label='locations' :collection="$locationNames" :options="['any', 'none']" type='selfref'/>
                        <x-filter_set label='occupations' :collection="$occupations" :options="['any', 'all', 'none']" type='selfref'/>
                        <x-filter_set label='taxes' :collection="$taxes" :options="['any', 'all', 'none']"/>
                        <x-filter_set label='lands' :collection="$lands" :options="['any', 'all', 'none']"/>
                        <x-filter_set label='real_estates' :collection="$realEstates" :options="['any', 'all', 'none']"/>
                        <x-filter_set label='livestocks' :collection="$livestocks" :options="['any', 'all', 'none']"/>
                        <x-filter_set label='member_type' :options="['any', 'none']" :collection="$memberTypes" />
                        <x-filter_set label='notes' :options="['contains', 'lacks']" type='text'/>
                        <x-filter_set label='forname' :options="['contains', 'lacks']" type='text'/>
                        <x-filter_set label='surname' :options="['contains', 'lacks']" type='text'/>
                        <x-filter_set label='occupation_income' :options="['>', '<', '=']" type='number'/>
                        <x-filter_set label='tax_amount' :options="['>', '<', '=']" type='number'/>
                        <x-filter_set label='land_area' :options="['>', '<', '=']" type='number'/>
                        <x-filter_set label='land_income' :options="['>', '<', '=']" type='number'/>
                        <x-filter_set label='land_rent' :options="['>', '<', '=']" type='number'/>
                        <x-filter_set label='land_location' :options="['contains', 'lacks']" type='text'/>
                        <x-filter_set label='land_description' :options="['contains', 'lacks']" type='text'/>
                        <x-filter_set label='real_estate_quantity' :options="['>', '<', '=']" type='number'/>
                        <x-filter_set label='real_estate_income' :options="['>', '<', '=']" type='number'/>
                        <x-filter_set label='real_estate_location' :options="['contains', 'lacks']" type='text'/>
                        <x-filter_set label='real_estate_description' :options="['contains', 'lacks']" type='text'/>
                        <x-filter_set label='livestock_quantity' :options="['>', '<', '=']" type='number'/>
                        <x-filter_set label='livestock_income' :options="['>', '<', '=']" type='number'/> 
                        <x-filter_set label='total_income' :options="['>', '<', '=']" type='number'/> 
                    </div>
                </div>
            </div>
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