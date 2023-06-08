@props(['occupations', 'new' => false])
<div x-data="{ occupations: [], number: 1}" class="mt-4">
    <template x-for="occupation in occupations">
        @include("_transition")
            <label x-bind:for="occupation.name" x-text="'Occupation ' + occupation.number">

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
            <label x-bind:for="occupation.income" x-text="'Occupation Income ' + occupation.number"></label>
            <input type="number" x-bind:name="occupation.income" x-bind:id="occupation.income"
                class="p-3 my-2 w-full text-gray-700 border @error('occupation.income') border-red-500 @enderror"
            >
        </div>
    </template>
    <div class="flex justify-between mt-3">
        <button x-on:click.prevent="occupations.push({
                                        name: 'occupation_{{ $new ? "new_" : "" }}id_' + number, 
                                        number: number, 
                                        income: 'occupation_{{ $new ? "new_" : "" }}income_' + number
                                    }); number++"
            class="inline-block bg-green-900 hover:bg-green-600 text-white py-2 px-2 rounded text-sm text-center">
            Add Occupation
        </button>
        <button x-on:click.prevent="if(occupations.length > 0) {occupations.pop(); number--}" 
                class="inline-block bg-red-900 hover:bg-red-600 text-white py-2 px-2 rounded text-sm text-center">
            Remove Occupation
        </button>
    </div>
</div>