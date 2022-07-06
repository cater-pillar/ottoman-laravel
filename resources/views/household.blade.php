<x-layout>
    <table class="table-auto mx-auto">
        <tr class="bg-gray-300">
            <th class="border p-3">
                Archive Code
            </th>
            <th class="border p-3">
                Page No
            </th>
            <th class="border p-3">
                Location
            </th>
            <th class="border p-3">
                House No
            </th>
            <th class="border p-3">
                Name
            </th>
            <th class="border p-3">
                Father Name
            </th>
            <th class="border p-3">
                Position
            </th>
        </tr>
        <tr>
            <td class="border p-3">
                {{ $household->archive_code }}
            </td>
            <td class="border p-3">
                {{ $household->page }}
            </td>
            <td class="border p-3">
                {{ $household->locationName->name . " " 
                . $household->locationName->locationType->name_en }}
            </td>
            <td class="border p-3">
                {{ $household->number }}
            </td>
            <td class="border p-3">
                {{ $household->forname }}
            </td>
            <td class="border p-3">
                {{ $household->surname }}
            </td>
            <td class="border p-3">
                {{ $household->memberType->name_en }}
            </td>
        </tr>
        @if ($household->notes !== "")
            <tr class="bg-gray-300">
                <th class="border p-3" colspan="7">
                    Notes
                </th>
            </tr>
            <tr >
                <td class="border p-3" colspan="7">
                    {{ $household->notes }}
                </td>
            </tr>    
        @endif
        @if (!$household->occupations->isEmpty())
            <tr class="bg-gray-300">
                <th class="border p-3" colspan="6">
                    Occupation
                </th>
                <th class="border p-3">
                    Income
                </th>
            </tr>
            @foreach ($household->occupations as $occupation)
                <tr >
                    <td class="border p-3" colspan="3">
                        {{ $occupation->name_tr }}
                    </td>
                    <td class="border p-3" colspan="3">
                        {{ $occupation->name_en }}
                    </td>
                    <td class="border p-3">
                        {{ $occupation->pivot->income }}
                    </td>
                </tr>
            @endforeach
        @endif
        @if (!$household->taxes->isEmpty())
        <tr class="bg-gray-300">
            <th class="border p-3" colspan="6">
                Tax
            </th>
            <th class="border p-3">
                Amount
            </th>
        </tr>
        @foreach ($household->taxes as $tax)
            <tr >
                <td class="border p-3" colspan="3">
                    {{ $tax->name_tr }}
                </td>
                <td class="border p-3" colspan="3">
                    {{ $tax->name_en }}
                </td>
                <td class="border p-3">
                    {{ $tax->pivot->amount }}
                </td>
            </tr>
        @endforeach
    @endif
    @if (!$household->livestocks->isEmpty())
        <tr class="bg-gray-300">
            <th class="border p-3" colspan="5">
                Livestock
            </th>
            <th class="border p-3">
                Quantity
            </th>
            <th class="border p-3">
                Income
            </th>
        </tr>
        @foreach ($household->livestocks as $livestock)
            <tr >
                <td class="border p-3" colspan="3">
                    {{ $livestock->name_tr }}
                </td>
                <td class="border p-3" colspan="2">
                    {{ $livestock->name_en }}
                </td>
                <td class="border p-3">
                    {{ $livestock->pivot->quantity }}
                </td>
                <td class="border p-3">
                    {{ $livestock->pivot->income }}
                </td>
            </tr>
        @endforeach
    @endif
    @if (!$household->realEstates->isEmpty())
        <tr class="bg-gray-300">
            <th class="border p-3" colspan="3">
                Real Estate
            </th>
            <th class="border p-3">
                Quantity
            </th>
            <th class="border p-3">
                Income
            </th>
            <th class="border p-3">
                Location
            </th>
            <th class="border p-3">
                Description
            </th>
        </tr>
        @foreach ($household->realEstates as $realEstate)
            <tr >
                <td class="border p-3" colspan="2" >
                    {{ $realEstate->name_tr }}
                </td>
                <td class="border p-3">
                    {{ $realEstate->name_en }}
                </td>
                <td class="border p-3">
                    {{ $realEstate->pivot->quantity }}
                </td>
                <td class="border p-3">
                    {{ $realEstate->pivot->income }}
                </td>
                <td class="border p-3">
                    {{ $realEstate->pivot->location }}
                </td>
                <td class="border p-3">
                    {{ $realEstate->pivot->description }}
                </td>
            </tr>
        @endforeach
    @endif
    @if (!$household->lands->isEmpty())
        <tr class="bg-gray-300">
            <th class="border p-3" colspan="2">
                Land
            </th>
            <th class="border p-3">
                Area
            </th>
            <th class="border p-3">
                Income
            </th>
            <th class="border p-3">
                Rent
            </th>
            <th class="border p-3">
                Location
            </th>
            <th class="border p-3">
                Description
            </th>
        </tr>
        @foreach ($household->lands as $land)
            <tr >
                <td class="border p-3" >
                    {{ $land->name_tr }}
                </td>
                <td class="border p-3">
                    {{ $land->name_en }}
                </td>
                <td class="border p-3">
                    {{ $land->pivot->area }}
                </td>
                <td class="border p-3">
                    {{ $land->pivot->income }}
                </td>
                <td class="border p-3">
                    {{ $land->pivot->rent }}
                </td>
                <td class="border p-3">
                    {{ $land->pivot->location }}
                </td>
                <td class="border p-3">
                    {{ $land->pivot->description }}
                </td>
            </tr>
        @endforeach
    @endif
    </table>
    <div class="conatiner mx-auto p-4 flex justify-between">
        <a href={{ "/household/$prevId" }} 
           class="inline-block bg-blue-900 hover:bg-blue-600 text-white px-3 py-1 rounded">
           <
        </a>
        <a href={{ "/household/$nextId" }} 
           class="inline-block bg-blue-900 hover:bg-blue-600 text-white px-3 py-1 rounded">
           >
        </a>
    </div>
</x-layout>