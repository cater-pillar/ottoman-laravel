<x-layout>
    <table class="container">
        <tr class="bg-gray-300">
            <td class="border p-3">
                Location Name
            </td>
            <td class="border p-3">
                Location Type
            </td>
            <td class="border p-3">
                Household Number
            </td>
            <td class="border p-3">
                Name
            </td>
            <td class="border p-3">
                Father Name
            </td>
            <td class="border p-3">
                Position in Household
            </td>
            <td class="border p-3">
                Archive Code
            </td>
            <td class="border p-3">
                Page
            </td>
        </tr>
    @foreach ($households as $household)
        <tr class="odd:bg-gray-100">
            <td class="border p-3">
                <a href={{ '/household/' . $household->id }}> 
                {{ $household->locationName->name }}
                </a>
            </td>
            <td class="border p-3">
                {{ $household->locationName->locationType->name_en }}
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
            <td class="border p-3">
                {{ $household->archive_code }}
            </td>
            <td class="border p-3">
                {{ $household->page }}
            </td>
        </tr>
    @endforeach
    </table>
    <div class="container mt-10">
        {{ $households->links()}}
    </div>
    
</x-layout>