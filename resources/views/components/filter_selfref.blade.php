@props(['label','collection', 'type'])
@if ($collection->count() > 0 && $type === 'selfref')
<div class="overflow-auto max-h-96">
    @foreach ($collection as $item)
        @if ($item->children()->count() === 0)
            <div class="pl-4 hover:bg-gray-700 hover:text-gray-300 relative border-y py-2 bg-gray-200 font-bold">
                <input type="checkbox" 
                       name="{{ $label .'_'. $item->id }}" 
                       id="{{ $label .'_'. $item->id }}"
                       value="{{$item->id}}"  
                       class="absolute left-2 top-2"
                       x-model="tempData.refKeys">
                <label for="{{ $label .'_'. $item->id }}" 
                        class="inline-block w-full pl-2">
                    @if($item instanceof App\Models\Occupation)
                        {{ $item->name_tr . " (" . $item->name_en . ")" }}
                    @endif
                    @if($item instanceof App\Models\LocationName)
                        {{ $item->name_tr . " " . $item->locationType->name_en }}
                    @endif
                </label>
            </div>
        @endif
        @if ($item->children->count() > 0)
            <div class="inline-block w-full pl-2 py-2 bg-gray-200 font-bold border-y">
                @if($item instanceof App\Models\Occupation)
                    {{ $item->name_tr . " (" . $item->name_en . ")" }}
                @endif
                @if($item instanceof App\Models\LocationName)
                    {{ $item->name_tr . " " . $item->locationType->name_en }}
                @endif
            </div>
            @foreach ($item->children as $child)
                @if ($child->children->count() === 0)
                    <div class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300 relative">
                        <input type="checkbox" 
                               name="{{ $label .'_'. $child->id }}" 
                               id="{{ $label .'_'. $child->id }}" 
                               value="{{$child->id}}"
                               class="absolute left-2 top-2"
                               x-model="tempData.refKeys">
                        <label for="{{ $label .'_'. $child->id }}"
                                class="inline-block w-full pl-2">
                            @if($child instanceof App\Models\Occupation)
                                {{ $child->name_tr . " (" . $child->name_en . ")" }}
                            @endif
                            @if($child instanceof App\Models\LocationName)
                                {{ $child->name_tr . " " . $child->locationType->name_en }}
                            @endif
                        </label>
                    </div>              
                @endif
                @if ($child->children->count() > 0)
                    <div class="inline-block w-full pl-4 py-2 font-bold border-y">
                        @if($child instanceof App\Models\Occupation)
                            {{ $child->name_tr . " (" . $child->name_en . ")" }}
                        @endif
                        @if($child instanceof App\Models\LocationName)
                            {{ $child->name_tr . " " . $child->locationType->name_en }}
                        @endif
                    </div>   
                    @foreach ($child->children as $grandchild)
                        @if ($grandchild->children->count() === 0)
                            <div class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300 relative">
                                <input type="checkbox" 
                                    name="{{ $label .'_'. $grandchild->id }}" 
                                    id="{{ $label .'_'. $grandchild->id }}" 
                                    value="{{$grandchild->id}}"
                                    class="absolute left-2 top-2" 
                                    x-model="tempData.refKeys">
                                <label for="{{ $label .'_'. $grandchild->id }}"
                                        class="inline-block w-full pl-2">
                                    @if($grandchild instanceof App\Models\Occupation)
                                        {{ $grandchild->name_tr . " (" . $grandchild->name_en . ")" }}
                                    @endif
                                    @if($grandchild instanceof App\Models\LocationName)
                                        {{ $grandchild->name_tr . " " . $grandchild->locationType->name_en }}
                                    @endif
                                </label>
                            </div> 
                        @endif
                        @if ($grandchild->children->count() > 0)
                            <div class="inline-block w-full pl-4 py-2 font-bold border-y">
                                @if($grandchild instanceof App\Models\Occupation)
                                    {{ $grandchild->name_tr . " (" . $grandchild->name_en . ")" }}
                                @endif
                                @if($child instanceof App\Models\LocationName)
                                    {{ $grandchild->name_tr . " " . $grandchild->locationType->name_en }}
                                @endif
                            </div>
                            <div class="pl-4 border-b">
                                @foreach ($grandchild->children as $descendent)
                                    <div class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300 relative">
                                        <input type="checkbox" 
                                            name="{{ $label .'_'. $descendent->id }}" 
                                            id="{{ $label .'_'. $descendent->id }}" 
                                            value="{{$descendent->id}}"
                                            class="absolute left-2 top-2" 
                                            x-model="tempData.refKeys">
                                        <label for="{{ $label .'_'. $descendent->id }}"
                                                class="inline-block w-full pl-2">
                                            @if($descendent instanceof App\Models\Occupation)
                                                {{ $descendent->name_tr . " (" . $descendent->name_en . ")" }}
                                            @endif
                                            @if($grandchild instanceof App\Models\LocationName)
                                                {{ $descendent->name_tr . " " . $descendent->locationType->name_en }}
                                            @endif
                                        </label>
                                    </div>  
                                @endforeach
                            </div>
                        @endif
                    @endforeach        
                @endif
            @endforeach
        @endif
    @endforeach
</div>
@endif
