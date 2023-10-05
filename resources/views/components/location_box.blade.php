@props(['collection'])

    <div class="border p-2">
        <p>Locations</p>
        @foreach ($collection as $root)
        <div x-data="{openChild: false}">
            <input type="checkbox" name='{{"location_$root->id"}}' 
                   id='{{"location_$root->id"}}' x-model="openChild">
            <label for='{{"location_$root->id"}}' >
                {{ $root->name_tr }}
            </label>
            @if ($root->children->count() > 0)
                <div class="border m-2 p-2" x-show="openChild">
                    @foreach ($root->children as $child)
                    <div x-data="{openGrandchild: false}">
                        <input type="checkbox" name='{{"location_$child->id"}}' 
                               id='{{"location_$child->id"}}' x-model="openGrandchild">
                        <label for='{{"location_$child->id"}}'>
                            {{ $child->name_tr  }}
                        </label>
                        @if ($child->children->count() > 0)
                            <div class="border m-2 p-2" x-show="openGrandchild">
                                @foreach ($child->children as $grandchild)
                                <div x-data="{openDescendant: false}">
                                    <input type="checkbox" name='{{"location_$grandchild->id"}}' 
                                           id='{{"location_$grandchild->id"}}' x-model="openDescendant">
                                    <label for='{{"location_$grandchild->id"}}'>
                                        {{ $grandchild->name_tr }}
                                    </label>
                                    @if ($grandchild->children->count() > 0)
                                    <div class="border m-2 p-2" x-show="openDescendant">
                                        @foreach ($grandchild->children as $descendant)
                                        <div>
                                            <input type="checkbox" name='{{"location_$descendant->id"}}' 
                                                   id='{{"location_$descendant->id"}}'>
                                            <label for='{{"location_$descendant->id"}}'>
                                                {{ $descendant->name_tr }}
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
