@props(['livestocks', 'new' => false])
<div x-data="{ livestocks: [], number: 1}" class="mt-4">
    <template x-for="livestock in livestocks">
        <div @include("_transition") >
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
            {name: 'livestock_{{ $new ? "new_" : "" }}id_'+number, 
            number: number, 
            quantity: 'livestock_{{ $new ? "new_" : "" }}quantity_'+number, 
            income: 'livestock_{{ $new ? "new_" : "" }}income_'+number
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