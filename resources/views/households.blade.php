<x-layout>
    @include('_success')
    <div>
        <form action="/households" method="get">
            <x-select  label='occupations' name='occupations' :collection="$occupations"/>
            <x-select  label='taxes' name='taxes' :collection="$taxes"/>
            <x-select  label='locations' name='locations' :collection="$locationNames"/>
            <x-btn-submit />
        </form>
    </div>
    <div>
        {{ $count }}
    </div>
    <table class="container">
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
                <a href={{ '/household/' . $household->id }}> 
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