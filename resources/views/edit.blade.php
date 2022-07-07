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

    </table>
</form>
</x-layout>