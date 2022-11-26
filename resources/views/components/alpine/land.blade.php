@props(['lands'])
<div x-data="{ lands: [], number: 1}" class="mt-4">
    <template x-for="land in lands">
        @include("_transition")
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
            {name: 'land_id_'+number, 
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