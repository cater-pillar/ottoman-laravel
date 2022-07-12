@props(['realEstates'])
<div x-data="{ realEstates: [], number: 1}" class="mt-4">
    <template x-for="realEstate in realEstates">
        <div
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform origin-top scale-y-0"
        x-transition:enter-end="transform origin-top scale-y-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="transform origin-top scale-y-100"
        x-transition:leave-end="transform origin-top scale-y-0"
        >
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