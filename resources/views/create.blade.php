<x-layout>
    <form action="/household/store" method="POST">
        @csrf
        <div class="mx-auto ">
            <x-select_loc label="Location" name="location_name_id" :collection="$locationNames" />
            <x-input name="number" label="Household number" placeholder="Household number" type='number' />
            <x-input name="archive_code" label="Archive Code" placeholder="Archive Code" />
            <x-input name="page" label="Page Number" placeholder="Page Number" type='number' />
            <x-input name="surname" label="Father Name" placeholder="Father Name" />
            <x-input name="forname" label="Name" placeholder="Name" />
            <x-input name="notes" label="Notes" placeholder="Notes..." />
            <x-select label="Position in the Household" name="member_type_id" :collection="$memberTypes" />
            <x-alpine.occupation :occupations="$occupations" :new="true"/> <!-- :new true is reduntant -->
            <x-alpine.tax :taxes="$taxes" :new="true"/>
            <x-alpine.land :lands="$lands" :new="true"/>
            <x-alpine.realestate :realEstates="$realEstates" :new="true"/>
            <x-alpine.livestock :livestocks="$livestocks" :new="true"/>
        <div class="py-10">
            <x-btn-submit />
        </div>
    </div>
    </form>
</x-layout>