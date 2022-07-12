<x-layout>
    <form action="/household/store" method="POST">
        @csrf
        <div class="mx-auto ">
            <label for="location_name_id">
                Location
            </label>
            <select name="location_name_id" id="location_name_id"
            class="p-3 my-2 w-full text-gray-700 border @error('location_name_id') border-red-500 @enderror"
                >
                @foreach ($locationNames as $locationName)
                    <option value="{{ $locationName->id }}">
                        {{ $locationName->name_tr }}
                    </option>
                @endforeach
            </select>
            <label for="number">
                Household Number
            </label>
            <input  type='number' 
            id="number" 
            name="number" 
            placeholder="Household number"
            class="p-3 my-2 w-full text-gray-700 border @error('number') border-red-500 @enderror"
            min="0"
           > 
           <label for="archive_code">
            Archive Code
            </label>   
            <input  type='text' 
            id="archive_code" 
            name="archive_code" 
            placeholder="Archive Code"
            class="p-3 my-2 w-full text-gray-700 border @error('archive_code') border-red-500 @enderror"
           > 
           <label for="page">
            Page Number
            </label>   
            <input  type='number'
            id="page" 
            name="page" 
            placeholder="Page number"
            class="p-3 my-2 w-full text-gray-700 border @error('page') border-red-500 @enderror"
            min="0"
           >    
           <label for="surname">
            Father Name
           </label>
            <input  type='text' 
            id="surname" 
            name="surname" 
            placeholder="Surname"
            class="p-3 my-2 w-full text-gray-700 border @error('surname') border-red-500 @enderror"
           >    
           <label for="forname">
            Name
           </label>
            <input  type='text' 
            id="forname" 
            name="forname" 
            placeholder="Forname"
            class="p-3 my-2 w-full text-gray-700 border @error('forname') border-red-500 @enderror"
           >    
           <label for="notes">
            Notes
           </label>
            <input  type='text' 
            id="notes" 
            name="notes" 
            placeholder="Notes..."
            class="p-3 my-2 w-full text-gray-700 border @error('notes') border-red-500 @enderror"
           >
           <label for="member_type_id">
            Position in the Household
           </label>
           <select name="member_type_id" id="member_type_id"
           class="p-3 my-2 w-full text-gray-700 border @error('member_type_id') border-red-500 @enderror"
            >
            @foreach ($memberTypes as $memberType)
                <option value="{{ $memberType->id }}">
                    {{ $memberType->name_tr ."/". $memberType->name_en}}
                </option>
            @endforeach
        </select>
        <div x-data="{ occupations: [], number: 1}">
            <template x-for="occupation in occupations">
                <div>
                <label x-bind:for="occupation.name" x-text="'Occupation '+occupation.number">

                </label>
                <select x-bind:name="occupation.name" x-bind:id="occupation.name" 
                class="p-3 my-2 w-full text-gray-700 border @error('occupation_id') border-red-500 @enderror"
                 >
                 @foreach ($occupations as $occupation)
                     <option value="{{ $occupation->id }}">
                         {{ $occupation->name_tr ."/". $occupation->name_en}}
                     </option>
                 @endforeach
             </select>
                <label x-bind:for="occupation.income" x-text="'Occupation Income '+occupation.number"></label>
                <input type="number" x-bind:name="occupation.income" x-bind:id="occupation.income"
                        class="p-3 my-2 w-full text-gray-700 border @error('occupation.income') border-red-500 @enderror"
                >
            </div>
            </template>
            <div class="flex justify-between mt-3">
                <button x-on:click.prevent="occupations.push({name: 'occupation_'+number, number: number, income: 'occupation_income_'+number}) ; number++"
                    class="inline-block bg-green-900 hover:bg-green-600 text-white py-2 px-2 rounded text-sm text-center">
                    Add Occupation
                </button>
                <button x-on:click.prevent="if(occupations.length > 0) {occupations.pop() ; number--}" 
                    class="inline-block bg-red-900 hover:bg-red-600 text-white py-2 px-2 rounded text-sm text-center">
                    Remove Occupation
                </button>
            </div>
        </div>
        <div x-data="{ taxes: [], number: 1}">
            <template x-for="tax in taxes">
                <div>
                <label x-bind:for="tax.name" x-text="'Tax '+tax.number">

                </label>
                <select x-bind:name="tax.name" x-bind:id="tax.name" 
                class="p-3 my-2 w-full text-gray-700 border @error('tax_id') border-red-500 @enderror"
                 >
                 @foreach ($taxes as $tax)
                     <option value="{{ $tax->id }}">
                         {{ $tax->name_tr ."/". $tax->name_en}}
                     </option>
                 @endforeach
             </select>
                <label x-bind:for="tax.amount" x-text="'Tax Amount '+tax.number"></label>
                <input type="number" x-bind:name="tax.amount" x-bind:id="tax.amount"
                        class="p-3 my-2 w-full text-gray-700 border @error('tax.amount') border-red-500 @enderror"
                >
            </div>
            </template>
            <div class="flex justify-between mt-3">
                <button x-on:click.prevent="taxes.push({name: 'tax_'+number, number: number, amount: 'tax_amount_'+number}) ; number++"
                    class="inline-block bg-green-900 hover:bg-green-600 text-white py-2 px-2 rounded text-sm text-center">
                    Add Tax
                </button>
                <button x-on:click.prevent="if(taxes.length > 0) {taxes.pop() ; number--}" 
                    class="inline-block bg-red-900 hover:bg-red-600 text-white py-2 px-2 rounded text-sm text-center">
                    Remove Tax
                </button>
            </div>
        </div>
        <div x-data="{ lands: [], number: 1}">
            <template x-for="land in lands">
                <div>
                <label x-bind:for="land.name" x-text="'Land '+land.number">

                </label>
                <select x-bind:name="land.name" x-bind:id="land.name" 
                class="p-3 my-2 w-full text-gray-700 border @error('land_id') border-red-500 @enderror"
                 >
                 @foreach ($lands as $land)
                     <option value="{{ $land->id }}">
                         {{ $land->name_tr ."/". $land->name_en}}
                     </option>
                 @endforeach
             </select>
                <label x-bind:for="land.area" x-text="'Land Area '+land.number"></label>
                <input type="number" x-bind:name="land.area" x-bind:id="land.area"
                        class="p-3 my-2 w-full text-gray-700 border @error('land.area') border-red-500 @enderror"
                >
                <label x-bind:for="land.income" x-text="'Land Income '+land.number"></label>
                <input type="number" x-bind:name="land.income" x-bind:id="land.income"
                        class="p-3 my-2 w-full text-gray-700 border @error('land.income') border-red-500 @enderror"
                >
                <label x-bind:for="land.rent" x-text="'Land Rent '+land.number"></label>
                <input type="number" x-bind:name="land.rent" x-bind:id="land.rent"
                        class="p-3 my-2 w-full text-gray-700 border @error('land.rent') border-red-500 @enderror"
                >
                <label x-bind:for="land.location" x-text="'Land Location '+land.number"></label>
                <input type="text" x-bind:name="land.location" x-bind:id="land.location"
                        class="p-3 my-2 w-full text-gray-700 border @error('land.location') border-red-500 @enderror"
                >
                <label x-bind:for="land.description" x-text="'Land Description '+land.number"></label>
                <input type="text" x-bind:name="land.description" x-bind:id="land.description"
                        class="p-3 my-2 w-full text-gray-700 border @error('land.description') border-red-500 @enderror"
                >
            </div>
            </template>
            <div class="flex justify-between mt-3">
                <button x-on:click.prevent="lands.push(
                    {name: 'land_'+number, 
                    number: number, 
                    area: 'land_area_'+number, 
                    income: 'land_income_'+number, 
                    rent: 'land_rent_'+number,
                    location: 'land_location_'+number,
                    description: 'land_description_'+number,
                }) ; number++"
                    class="inline-block bg-green-900 hover:bg-green-600 text-white py-2 px-2 rounded text-sm text-center">
                    Add Land
                </button>
                <button x-on:click.prevent="if(lands.length > 0) {lands.pop() ; number--}" 
                    class="inline-block bg-red-900 hover:bg-red-600 text-white py-2 px-2 rounded text-sm text-center">
                    Remove Land
                </button>
            </div>
        </div>
        <div x-data="{ realEstates: [], number: 1}">
            <template x-for="realEstate in realEstates">
                <div>
                <label x-bind:for="realEstate.name" x-text="'Real Estate '+realEstate.number">

                </label>
                <select x-bind:name="realEstate.name" x-bind:id="realEstate.name" 
                class="p-3 my-2 w-full text-gray-700 border @error('real_estate_id') border-red-500 @enderror"
                 >
                 @foreach ($realEstates as $realEstate)
                     <option value="{{ $realEstate->id }}">
                         {{ $realEstate->name_tr ."/". $realEstate->name_en}}
                     </option>
                 @endforeach
             </select>
                <label x-bind:for="realEstate.quantity" x-text="'Real Estate Quantity '+realEstate.number"></label>
                <input type="number" x-bind:name="realEstate.quantity" x-bind:id="realEstate.quantity"
                        class="p-3 my-2 w-full text-gray-700 border @error('realEstate.quantity') border-red-500 @enderror"
                >
                <label x-bind:for="realEstate.income" x-text="'Real Estate Income '+realEstate.number"></label>
                <input type="number" x-bind:name="realEstate.income" x-bind:id="realEstate.income"
                        class="p-3 my-2 w-full text-gray-700 border @error('realEstate.income') border-red-500 @enderror"
                >
                <label x-bind:for="realEstate.location" x-text="'Real Estate Location '+realEstate.number"></label>
                <input type="text" x-bind:name="realEstate.location" x-bind:id="realEstate.location"
                        class="p-3 my-2 w-full text-gray-700 border @error('realEstate.location') border-red-500 @enderror"
                >
                <label x-bind:for="realEstate.description" x-text="'Real Estate Description '+realEstate.number"></label>
                <input type="text" x-bind:name="realEstate.description" x-bind:id="realEstate.description"
                        class="p-3 my-2 w-full text-gray-700 border @error('realEstate.description') border-red-500 @enderror"
                >
            </div>
            </template>
            <div class="flex justify-between mt-3">
                <button x-on:click.prevent="realEstates.push(
                    {name: 'real_estate_'+number, 
                    number: number, 
                    quantity: 'real_estate_quantity_'+number, 
                    income: 'real_estate_income_'+number, 
                    location: 'real_estate_location_'+number,
                    description: 'real_estate_description_'+number,
                }) ; number++"
                    class="inline-block bg-green-900 hover:bg-green-600 text-white py-2 px-2 rounded text-sm text-center">
                    Add Real Estate
                </button>
                <button x-on:click.prevent="if(realEstates.length > 0) {realEstates.pop() ; number--}" 
                    class="inline-block bg-red-900 hover:bg-red-600 text-white py-2 px-2 rounded text-sm text-center">
                    Remove Real Estate
                </button>
            </div>
        </div>
        <div x-data="{ livestocks: [], number: 1}">
            <template x-for="livestock in livestocks">
                <div>
                <label x-bind:for="livestock.name" x-text="'Livestock '+livestock.number">

                </label>
                <select x-bind:name="livestock.name" x-bind:id="livestock.name" 
                class="p-3 my-2 w-full text-gray-700 border @error('livestock_id') border-red-500 @enderror"
                 >
                 @foreach ($livestocks as $livestock)
                     <option value="{{ $livestock->id }}">
                         {{ $livestock->name_tr ."/". $livestock->name_en}}
                     </option>
                 @endforeach
             </select>
                <label x-bind:for="livestock.quantity" x-text="'Livestock Quantity '+livestock.number"></label>
                <input type="number" x-bind:name="livestock.quantity" x-bind:id="livestock.quantity"
                        class="p-3 my-2 w-full text-gray-700 border @error('livestock.quantity') border-red-500 @enderror"
                >
                <label x-bind:for="livestock.income" x-text="'Livestock Income '+livestock.number"></label>
                <input type="number" x-bind:name="livestock.income" x-bind:id="livestock.income"
                        class="p-3 my-2 w-full text-gray-700 border @error('livestock.income') border-red-500 @enderror"
                >
            </div>
            </template>
            <div class="flex justify-between mt-3">
                <button x-on:click.prevent="livestocks.push(
                    {name: 'livestock_'+number, 
                    number: number, 
                    quantity: 'livestock_quantity_'+number, 
                    income: 'livestock_income_'+number
                }) ; number++"
                    class="inline-block bg-green-900 hover:bg-green-600 text-white py-2 px-2 rounded text-sm text-center">
                    Add Livestock
                </button>
                <button x-on:click.prevent="if(livestocks.length > 0) {livestocks.pop() ; number--}" 
                    class="inline-block bg-red-900 hover:bg-red-600 text-white py-2 px-2 rounded text-sm text-center">
                    Remove Livestock
                </button>
            </div>
        </div>
        <div class="py-10">
            <x-btn-submit />
        </div>
    </div>
    </form>
</x-layout>