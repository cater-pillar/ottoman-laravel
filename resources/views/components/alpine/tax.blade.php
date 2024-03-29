@props(['taxes', 'new' => false])
<div x-data="{ taxes: [], number: 1}" class="mt-4">
    <template x-for="tax in taxes">
        <div @include("_transition") >
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
        <button x-on:click.prevent="taxes.push({
                                    name: 'tax_{{ $new ? "new_" : "" }}id_'+number, 
                                    number: number, 
                                    amount: 'tax_{{ $new ? "new_" : "" }}amount_'+number
                                }) ; number++"
            class="inline-block bg-green-900 hover:bg-green-600 text-white py-2 px-2 rounded text-sm text-center">
            Add Tax
        </button>
        <button x-on:click.prevent="if(taxes.length > 0) {taxes.pop() ; number--}" 
            class="inline-block bg-red-900 hover:bg-red-600 text-white py-2 px-2 rounded text-sm text-center">
            Remove Tax
        </button>
    </div>
</div>