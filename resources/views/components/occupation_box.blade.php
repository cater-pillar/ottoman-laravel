@props(['collection'])

    <div class="border p-2 bg-gray-100 mb-3 select-none" >
        <p class="p-1 m-1 font-bold">Occupations</p>
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
