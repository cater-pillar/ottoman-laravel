<template x-if="filter === null">
    <ul class="overflow-auto h-96">
        <li x-on:click="filter = 'locations'; tempData.logic = 'any'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Locations</li>
        <li x-on:click="filter = 'occupations'; tempData.logic = 'any'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Occupations</li>
        <li x-on:click="filter = 'occupation_income'; tempData.logic = '>'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Occupation Income</li>
        <li x-on:click="filter = 'taxes'; tempData.logic = 'any'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Taxes</li>
        <li x-on:click="filter = 'tax_amount'; tempData.logic = '>'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Tax Amount</li>
        <li x-on:click="filter = 'lands'; tempData.logic = 'any'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Land</li>
        <li x-on:click="filter = 'land_area'; tempData.logic = '>'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Land Area</li>
        <li x-on:click="filter = 'land_income'; tempData.logic = '>'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Land Income</li>
        <li x-on:click="filter = 'land_rent'; tempData.logic = '>'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Land Rent</li>
        <li x-on:click="filter = 'real_estates'; tempData.logic = 'any'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Real Estate</li>
        <li x-on:click="filter = 'real_estate_quantity'; tempData.logic = '>'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Real Estate Quantity</li>
        <li x-on:click="filter = 'real_estate_income'; tempData.logic = '>'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Real Estate Income</li>
        <li x-on:click="filter = 'livestocks'; tempData.logic = 'any'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Livestock</li>
        <li x-on:click="filter = 'livestock_quantity'; tempData.logic = '>'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Livestock Quantity</li>
        <li x-on:click="filter = 'livestock_income'; tempData.logic = '>'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Livestock Income</li>
        <li x-on:click="filter = 'member_type'; tempData.logic = 'any'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Member Types</li>
        <li x-on:click="filter = 'notes'; tempData.logic = 'contains'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Notes</li>
        <li x-on:click="filter = 'forname'; tempData.logic = 'contains'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Forname</li>
        <li x-on:click="filter = 'surname'; tempData.logic = 'contains'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Surname</li>
        <li x-on:click="filter = 'total_income'; tempData.logic = '>'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Total Income</li>
        <!--
        <li x-on:click="filter = 'land_location'; tempData.logic = 'contains'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Land Location</li>
        <li x-on:click="filter = 'land_description'; tempData.logic = 'contains'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Land Description</li>
        <li x-on:click="filter = 'real_estate_location'; tempData.logic = 'contains'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Real Estate Location</li>
        <li x-on:click="filter = 'real_estate_description'; tempData.logic = 'contains'" class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300">Real Estate Description</li> 
        -->
    </ul>
</template>