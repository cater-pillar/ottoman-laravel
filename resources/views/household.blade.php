<x-layout>
    <div class="mx-auto w-min">
        @include('_success')
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
            
            <x-td :content="$household->archive_code" />
            <x-td :content="$household->page" />
            <x-td :content="$household->locationName->name_tr" />

            <x-td :content="$household->number" />
            <x-td :content="$household->forname" />
            <x-td :content="$household->surname" />
            <x-td :content="$household->memberType->name_en" />
        </tr>
        @if ($household->notes !== "" && $household->notes !== null)
            <tr class="bg-gray-300">
                <x-th content="Notes" colspan="7"/>
            </tr>
            <tr >
                <x-td :content="$household->notes" colspan="7" />
            </tr>    
        @endif
        @if (!$household->occupations->isEmpty())
            <tr class="bg-gray-300">
                <x-th content="Occupation" colspan="6"/>
                <x-th content="Income" />
            </tr>
            @foreach ($household->occupations as $occupation)
                <tr >
                    <x-td :content="$occupation->name_tr" colspan="3" />
                    <x-td :content="$occupation->name_en" colspan="3" />
                    <x-td :content="$occupation->pivot->income" />
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
                <x-td :content="$tax->name_tr" colspan="3" />
                <x-td :content="$tax->name_en" colspan="3" />
                <x-td :content="$tax->pivot->amount" />
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
                <x-td :content="$realEstate->name_tr" colspan='2'/>
                <x-td :content="$realEstate->name_en" />
                <x-td :content="$realEstate->pivot->quantity" />
                <x-td :content="$realEstate->pivot->income" />
                <x-td :content="$realEstate->pivot->location" />
                <x-td :content="$realEstate->pivot->description" />
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
                <x-td :content="$land->name_tr"/>
                <x-td :content="$land->name_en" />
                <x-td :content="$land->pivot->area" />
                <x-td :content="$land->pivot->income" />
                <x-td :content="$land->pivot->rent" />
                <x-td :content="$land->pivot->location" />
                <x-td :content="$land->pivot->description" />
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
                <x-td :content="$livestock->name_tr" colspan="3" />
                <x-td :content="$livestock->name_en" colspan="2" />
                <x-td :content="$livestock->pivot->quantity" />
                <x-td :content="$livestock->pivot->income" />
            </tr>
        @endforeach
    @endif
    </table>
    <div class="relative py-10">
        <x-prev :id="$prevId" />
        <div class="flex justify-center">
        <x-btn-delete :url="$household->id" />
        <x-btn-edit :url="$household->id" />
        <div>
        <x-next :id="$nextId" />
    </div>

    </div>
</x-layout>