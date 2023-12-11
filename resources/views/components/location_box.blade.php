@props(['collection'])

    <div class="border p-2 bg-gray-100 mb-3 select-none"
        @if(collect(request()->keys())
        ->filter(fn($key) => str_contains($key, 'location') && $key)
        ->count() > 0)
        x-data="{open:true}"
        @else
        x-data="{open:false}"
        @endif 
        >
        <p class="p-1 m-1 font-bold" x-on:click="open = ! open">Locations</p>
        <div x-cloak x-show="open" @include("_transition")>
        @foreach ($collection as $root)
        <div class="p-1 m-1 border max-w-fit rounded bg-white"
            @if(request("location_$root->id")) 
                x-data="{checked: true}"
            @else 
                x-data="{checked: false}"
            @endif
            @if ($root->children->count() == 0)
            :class="checked ? 'bg-blue-300' : ''"
            @endif 
            >
            <input type="checkbox" name='{{"location_$root->id"}}' 
                   id='{{"location_$root->id"}}' x-model="checked"
                   class="hidden"
                   >
            <label for='{{"location_$root->id"}}' >
                {{ $root->name_tr . " " . $root->locationType->name_en}}
            </label>
            @if ($root->children->count() > 0)
                <div class="border m-2 p-2 bg-gray-100" x-cloak x-show="checked" @include("_transition")>
                    @foreach ($root->children as $child)
                    <div class="inline-block p-1 m-1 border max-w-fit rounded bg-white"  
                         @if(request("location_$child->id"))
                            x-data="{checked:true}"
                         @else
                            x-data="{checked:false}"
                         @endif 
                         @if ($child->children->count() == 0)
                            :class="checked ? 'bg-blue-300' : ''"
                         @endif
                         >
                        <input type="checkbox" name='{{"location_$child->id"}}' 
                               id='{{"location_$child->id"}}' x-model="checked"
                               class="hidden"
                               >
                        <label for='{{"location_$child->id"}}'>
                            {{ $child->name_tr . " " . $child->locationType->name_en }}
                        </label>
                        @if ($child->children->count() > 0)
                            <div class="border m-2 p-2 bg-gray-100" x-cloak x-show="checked" @include("_transition")>
                                @foreach ($child->children as $grandchild)
                                <div    class="inline-block p-1 m-1 border max-w-fit rounded bg-white"
                                        @if(request("location_$grandchild->id"))
                                            x-data="{checked:true}"
                                        @else
                                            x-data="{checked:false}"
                                        @endif 
                                        @if ($grandchild->children->count() == 0)
                                            :class="checked ? 'bg-blue-300' : ''"
                                        @endif>
                                    <input type="checkbox" name='{{"location_$grandchild->id"}}' 
                                           id='{{"location_$grandchild->id"}}' x-model="checked"
                                           class="hidden">
                                    <label for='{{"location_$grandchild->id"}}'>
                                        {{ $grandchild->name_tr . " " . $grandchild->locationType->name_en }}
                                    </label>
                                    @if ($grandchild->children->count() > 0)
                                    <div class="border m-2 p-2 bg-gray-100" x-cloak x-show="checked" @include("_transition")>
                                        @foreach ($grandchild->children as $descendant)
                                        <div class="inline-block p-1 m-1 border max-w-fit rounded bg-white"
                                             @if(request("location_$descendant->id"))
                                                x-data="{checked:true}"
                                             @else
                                                x-data="{checked:false}"
                                             @endif 
                                             :class="checked ? 'bg-blue-300' : ''"
                                            >
                                            <input type="checkbox" name='{{"location_$descendant->id"}}' 
                                                   id='{{"location_$descendant->id"}}' x-model="checked" class="hidden">
                                            <label for='{{"location_$descendant->id"}}'>
                                                {{ $descendant->name_tr . " " . $descendant->locationType->name_en}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                @endif
                                </div>
                                @endforeach                                                            
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
        @endforeach
        </div>
    </div>
