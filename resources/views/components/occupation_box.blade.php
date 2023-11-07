@props(['collection'])

    <div class="border p-2 bg-gray-100 mb-3 select-none" 
            @if(collect(request()->keys())
            ->filter(fn($key) => str_contains($key, 'occupation') && $key)
            ->count() > 0)
            x-data="{open:true}"
            @else
            x-data="{open:false}"
            @endif 
        >
        <p class="p-1 m-1 font-bold" x-on:click="open = ! open">Occupations</p>
        <div x-cloak x-show="open">
        @foreach ($collection as $root)
            <div    class="p-1 m-1 border max-w-fit rounded bg-white"
                    @if(request("occupation_$root->id"))
                        x-data="{checked:true}"
                    @else
                        x-data="{checked:false}"
                    @endif 
                    @if ($root->children->count() == 0)
                    :class="checked ? 'bg-blue-300' : ''"
                    @endif
                >
                <input type="checkbox" name='{{ "occupation_$root->id" }}' 
                        id='{{ "occupation_$root->id" }}' x-model="checked"
                        class="hidden">
                <label for='{{ "occupation_$root->id" }}' >
                    {{ "$root->name_tr ($root->name_en)" }}
                </label>
                @if ($root->children->count() > 0)
                    <x-box_child :collection="$root->children" />
                @endif
            </div>        
        @endforeach
        </div>
    </div>
