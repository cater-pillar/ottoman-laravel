<x-layout>
<form class="mx-auto w-min" action="#" method="POST">
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
            <x-td-input :value="$household->page" name="page" />
            <x-td-select name="location" :current="$household->locationName->name_tr" :options="$locationNames" />
            <x-td-input :value="$household->number" name="number" />
            <x-td-input :value="$household->forname" name="forname" />
            <x-td-input :value="$household->surname" name="surname" />
            <x-td-select name="member_type" :current="$household->memberType->name_tr" :options="$memberTypes" />
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
                <x-td-select name="SOLVE THIS" :current="$occupation->name_tr" :options="$occupations" colspan="6" />
                <x-td-input name="SOLVE THIS" :value="$occupation->pivot->income" />
            </tr>
        @endforeach
        @endif
        @if (!$household->taxes->isEmpty())
        <tr class="bg-gray-300">
            <x-th content="Tax" colspan="6"/>
            <x-th content="Amount" />
        </tr>
        @foreach ($household->taxes as $tax)
            <tr >
                <x-td-select name="SOLVE THIS" :current="$tax->name_tr" :options="$taxes" colspan="6" />
                <x-td-input name="SOLVE THIS" :value="$tax->pivot->income" />
            </tr>
        @endforeach
    @endif
    @if (!$household->livestocks->isEmpty())
        <tr class="bg-gray-300">
            <x-th content="Livestock" colspan="5"/>
            <x-th content="Quantity" />
            <x-th content="Income" />
        </tr>
        @foreach ($household->livestocks as $livestock)
            <tr >
                <x-td-select name="SOLVE THIS" :current="$livestock->name_tr" :options="$livestocks" colspan="5" />
                <x-td-input  name="SOLVE THIS" :value="$livestock->pivot->quantity" />
                <x-td-input  name="SOLVE THIS" :value="$livestock->pivot->income" />
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
        @foreach ($household->realEstates as $realEstate)
            <tr >
                <x-td-select name="SOLVE THIS" :current="$realEstate->name_tr" :options="$realEstates" colspan="3" />
                <x-td-input  name="SOLVE THIS" :value="$realEstate->pivot->quantity" />
                <x-td-input  name="SOLVE THIS" :value="$realEstate->pivot->income" />
                <x-td-input  name="SOLVE THIS" :value="$realEstate->pivot->location" />
                <x-td-input  name="SOLVE THIS" :value="$realEstate->pivot->description" />
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
        @foreach ($household->lands as $land)
            <tr >
                <x-td-select name="SOLVE THIS" :current="$land->name_tr" :options="$lands" colspan="2" />
                <x-td-input  name="SOLVE THIS" :value="$land->pivot->area" />
                <x-td-input  name="SOLVE THIS" :value="$land->pivot->income" />
                <x-td-input  name="SOLVE THIS" :value="$land->pivot->rent" />
                <x-td-input  name="SOLVE THIS" :value="$land->pivot->location" />
                <x-td-input  name="SOLVE THIS" :value="$land->pivot->description" />
            </tr>
        @endforeach
    @endif
    </table>
</form>
</x-layout>