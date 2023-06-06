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
            <tr class="bg-gray-300">
                <x-th content="Notes" colspan="7"/>
            </tr>
            <tr >
                <x-td-input :value="$household->notes" name="notes" colspan="7" placeholder="Notes..." />
            </tr>    
        @if (!$household->occupations->isEmpty())
        <tr class="bg-gray-300">
            <x-th content="Occupation" colspan="6"/>
            <x-th content="Income" />
        </tr>
        @foreach ($household->occupations as $index => $occupation)
            <tr >
                <x-td-select name="occupation_id_" :index="$occupation->pivot->id" :current="$occupation" :options="$occupations" colspan="6" />
                <x-td-input name="occupation_income_" :index="$occupation->pivot->id" :value="$occupation->pivot->income" type="number"/>
            </tr>
        @endforeach
        @endif
        <tr>
            <td class="border p-4" colspan="7">
                <x-alpine.occupation :occupations="$occupations" />
            </td>
        </tr>
        @if (!$household->taxes->isEmpty())
        <tr class="bg-gray-300">
            <x-th content="Tax" colspan="6"/>
            <x-th content="Amount" />
        </tr>
        @foreach ($household->taxes as $index => $tax)
            <tr >
                <x-td-select name="tax_id_" :index="$tax->pivot->id" :current="$tax" :options="$taxes" colspan="6" />
                <x-td-input name="tax_amount_" :index="$tax->pivot->id" :value="$tax->pivot->amount" type="number"/>
            </tr>
        @endforeach
    @endif
    <tr>
        <td class="border p-4" colspan="7">
            <x-alpine.tax :taxes="$taxes" />
        </td>
    </tr>
    @if (!$household->livestocks->isEmpty())
        <tr class="bg-gray-300">
            <x-th content="Livestock" colspan="5"/>
            <x-th content="Quantity" />
            <x-th content="Income" />
        </tr>
        @foreach ($household->livestocks as $index => $livestock)
            <tr >
                <x-td-select name="livestock_id_" :index="$livestock->pivot->id" :current="$livestock" :options="$livestocks" colspan="5" />
                <x-td-input  name="livestock_quantity_" :index="$livestock->pivot->id" :value="$livestock->pivot->quantity" type="number"/>
                <x-td-input  name="livestock_income_" :index="$livestock->pivot->id" :value="$livestock->pivot->income" type="number"/>
            </tr>
        @endforeach
    @endif
    <tr>
        <td class="border p-4" colspan="7">
           <x-alpine.livestock :livestocks="$livestocks" />
        </td>
    </tr>
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
                <x-td-select name="real_estate_id_" :index="$realEstate->pivot->id" :current="$realEstate" :options="$realEstates" colspan="3" />
                <x-td-input  name="real_estate_quantity_" :index="$realEstate->pivot->id" :value="$realEstate->pivot->quantity" type="number"/>
                <x-td-input  name="real_estate_income_" :index="$realEstate->pivot->id" :value="$realEstate->pivot->income" type="number"/>
                <x-td-input  name="real_estate_location_" :index="$realEstate->pivot->id" :value="$realEstate->pivot->location" />
                <x-td-input  name="real_estate_description_" :index="$realEstate->pivot->id" :value="$realEstate->pivot->description" />
            </tr>
        @endforeach
    @endif
    <tr>
        <td class="border p-4" colspan="7">
            <x-alpine.realestate :realEstates="$realEstates" />
        </td>
    </tr>
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
                <x-td-select name="land_id_" :index="$land->pivot->id" :current="$land" :options="$lands" colspan="2" />
                <x-td-input  name="land_area_" :index="$land->pivot->id" :value="$land->pivot->area" type="number"/>
                <x-td-input  name="land_income_" :index="$land->pivot->id" :value="$land->pivot->income" type="number"/>
                <x-td-input  name="land_rent_" :index="$land->pivot->id" :value="$land->pivot->rent" type="number"/>
                <x-td-input  name="land_location_" :index="$land->pivot->id" :value="$land->pivot->location" />
                <x-td-input  name="land_description_" :index="$land->pivot->id" :value="$land->pivot->description" />
            </tr>
        @endforeach
    @endif
    <tr>
        <td class="border p-4" colspan="7">
           <x-alpine.land :lands="$lands" />
        </td>
    </tr>
    </table>
    <div class="py-10">
        <x-btn-submit />
    </div>
</div>
</form>
</x-layout>