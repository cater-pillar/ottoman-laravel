<x-layout>
<form action="/household/update/{{ $household->id }}" method="POST">
    @csrf
    <div class="mx-auto ">
    <table class="table-auto">
        <tr class="bg-gray-300">
            <x-th content="Archive Code" />
            <x-th content="Page No" />
            <x-th content="Location" />
            <x-th content="House No" />
            <x-th content="Name" />
            <x-th content="Father Name" />
            <x-th content="Position" />
        </tr>
        <tr>   
            <x-td-input :value="$household->archive_code" name="archive_code" />
            <x-td-input :value="$household->page" name="page" type="number" />
            <x-td-select name="location_name_id" :current="$household->locationName" :options="$locationNames" />
            <x-td-input :value="$household->number" name="number" type="number" />
            <x-td-input :value="$household->forname" name="forname" />
            <x-td-input :value="$household->surname" name="surname" />
            <x-td-select name="member_type_id" :current="$household->memberType" :options="$memberTypes" />
        </tr>
        @if ($household->notes !== "")
            <tr class="bg-gray-300">
                <x-th content="Notes" colspan="7"/>
            </tr>
            <tr >
                <x-td-input :value="$household->notes" name="notes" colspan="7" />
            </tr>    
        @endif
        @if (!$household->occupations->isEmpty())
        <tr class="bg-gray-300">
            <x-th content="Occupation" colspan="6"/>
            <x-th content="Income" />
        </tr>
        @foreach ($household->occupations as $index => $occupation)
            <tr >
                <x-td-select name="occupation-id-" :index="$index" :current="$occupation" :options="$occupations" colspan="6" />
                <x-td-input name="occupation-income-" :index="$index" :value="$occupation->pivot->income" type="number"/>
            </tr>
        @endforeach
        @endif
        @if (!$household->taxes->isEmpty())
        <tr class="bg-gray-300">
            <x-th content="Tax" colspan="6"/>
            <x-th content="Amount" />
        </tr>
        @foreach ($household->taxes as $index => $tax)
            <tr >
                <x-td-select name="tax-id-" :index="$index" :current="$tax" :options="$taxes" colspan="6" />
                <x-td-input name="tax-amount-" :index="$index" :value="$tax->pivot->amount" type="number"/>
            </tr>
        @endforeach
    @endif
    @if (!$household->livestocks->isEmpty())
        <tr class="bg-gray-300">
            <x-th content="Livestock" colspan="5"/>
            <x-th content="Quantity" />
            <x-th content="Income" />
        </tr>
        @foreach ($household->livestocks as $index => $livestock)
            <tr >
                <x-td-select name="livestock-id-" :index="$index" :current="$livestock" :options="$livestocks" colspan="5" />
                <x-td-input  name="livestock-quantity-" :index="$index" :value="$livestock->pivot->quantity" type="number"/>
                <x-td-input  name="livestock-income-" :index="$index" :value="$livestock->pivot->income" type="number"/>
            </tr>
        @endforeach
    @endif
    @if (!$household->realEstates->isEmpty())
        <tr class="bg-gray-300">
            <x-th content="Real Estate" colspan="3"/>
            <x-th content="Quantity" />
            <x-th content="Income" />
            <x-th content="Location" />
            <x-th content="Description" />
        </tr>
        @foreach ($household->realEstates as $index => $realEstate)
            <tr >
                <x-td-select name="real-estate-id-" :index="$index" :current="$realEstate" :options="$realEstates" colspan="3" />
                <x-td-input  name="real-estate-quantity-" :index="$index" :value="$realEstate->pivot->quantity" type="number"/>
                <x-td-input  name="real-estate-income-" :index="$index" :value="$realEstate->pivot->income" type="number"/>
                <x-td-input  name="real-estate-location-" :index="$index" :value="$realEstate->pivot->location" />
                <x-td-input  name="real-estate-description-" :index="$index" :value="$realEstate->pivot->description" />
            </tr>
        @endforeach
    @endif
    @if (!$household->lands->isEmpty())
        <tr class="bg-gray-300">
            <x-th content="Land" colspan="2"/>
            <x-th content="Area" />
            <x-th content="Income" />
            <x-th content="Rent" />
            <x-th content="Location" />
            <x-th content="Description" />
        </tr>
        @foreach ($household->lands as $index => $land)
            <tr >
                <x-td-select name="land-id-" :index="$index" :current="$land" :options="$lands" colspan="2" />
                <x-td-input  name="land-area-" :index="$index" :value="$land->pivot->area" type="number"/>
                <x-td-input  name="land-income-" :index="$index" :value="$land->pivot->income" type="number"/>
                <x-td-input  name="land-rent-" :index="$index" :value="$land->pivot->rent" type="number"/>
                <x-td-input  name="land-location-" :index="$index" :value="$land->pivot->location" />
                <x-td-input  name="land-description-" :index="$index" :value="$land->pivot->description" />
            </tr>
        @endforeach
    @endif
    </table>
    <div class="py-10">
        <x-btn-submit />
    </div>
</div>
</form>
</x-layout>