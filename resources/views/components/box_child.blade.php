@props(['collection'])

<div class="border m-2 p-2 bg-gray-100" x-cloak x-show="checked">
    @foreach ($collection as $item)
        <div class="inline-block p-1 m-1 border max-w-fit rounded bg-white" 
            @if(request("occupation_$item->id"))
                x-data="{checked:true}"
             @else
                x-data="{checked:false}"
             @endif 
             @if ($item->children->count() == 0)
             :class="checked ? 'bg-blue-300' : ''"
             @endif >
            <input type="checkbox" name='{{ "occupation_$item->id" }}' 
                    id='{{ "occupation_$item->id" }}' x-model="checked" class="hidden">
            <label for='{{ "occupation_$item->id" }}'>
                {{ "$item->name_tr ($item->name_en)"  }}
            </label>
            @if ($item->children->count() > 0)
                <x-box_inner :collection="$item->children" />
            @endif
        </div>
    @endforeach
</div>