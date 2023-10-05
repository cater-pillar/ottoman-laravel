@props(['collection'])

    <div class="border p-2" >
        <p>Occupations</p>
        @foreach ($collection as $root)
            <div x-data="{openChild: false}">
                <input type="checkbox" name='{{ "occupation_$root->id" }}' 
                        id='{{ "occupation_$root->id" }}' x-model="openChild">
                <label for='{{ "occupation_$root->id" }}' >
                    {{ "$root->name_tr ($root->name_en)" }}
                </label>
                @if ($root->children->count() > 0)
                    <div class="border m-2 p-2" x-show="openChild">
                        @foreach ($root->children as $child)
                            <div x-data="{openDescendant: false}">
                                <input type="checkbox" name='{{ "occupation_$child->id" }}' 
                                        id='{{ "occupation_$child->id" }}' x-model="openDescendant">
                                <label for='{{ "occupation_$child->id" }}'>
                                    {{ "$child->name_tr ($child->name_en)"  }}
                                </label>
                                @if ($child->children->count() > 0)
                                    <div class="border m-2 p-2" x-show="openDescendant">
                                        @foreach ($child->children as $descendant)
                                            <div>
                                                <input type="checkbox" name='{{ "occupation_$descendant->id" }}' 
                                                    id='{{ "occupation_$descendant->id" }}'>
                                                <label for='{{ "occupation_$descendant->id" }}'>
                                                    {{ "$descendant->name_tr ($descendant->name_en)" }}
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
