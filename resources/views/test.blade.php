<x-layout>
<div x-data="{ root : 0, parent : 0}" class="mt-4">
    


    <label for="occ-root" >
        Occupation Group
    </label>

    <select name="occ-root" id="occ-root" x-model="root" x-on:change="parent = 0"
            class="p-3 my-2 w-full text-gray-700 border">
    
        <option value="">...</option>
    
        @foreach ($jobs as $job)
            @if($job->isRoot())
            <option value="{{ $job->id }}">
                {{ $job->name_tr }} : {{ $job->name_en}}
            </option>
            @endif
        @endforeach

    </select>
    


    @foreach ($jobs as $parent)
    @if($parent->isRoot() && $parent->children->all() !== [])
    <template x-if="root == {{$parent->id}}">
        @include("_transition")

        <label for="occ-1-child" >
            Occupation Subgroup
        </label>

        <select name="occ-1-child" id="occ-1-child" x-model="parent"
                class="p-3 my-2 w-full text-gray-700 border">
            
            <option value="">...</option>
            
            
            @foreach ($jobs as $job)
                @if($job->parent_id == $parent->id)
                    <option value="{{ $job->id }}">
                        {{ $job->name_tr }} : {{ $job->name_en}}
                    </option>
                @endif
            @endforeach
          
        </select>
        </div>
    </template>
    @endif
    @endforeach


    @foreach ($jobs as $child)
    @if($child->isChild() && $child->children->all() !== [])
    <template x-if="parent == {{$child->id}}">
    @include("_transition")

        <label for="occ-1-child" >
            Occupation
        </label>
        <select name="occ-1-child" id="occ-1-child"
                class="p-3 my-2 w-full text-gray-700 border"
            >
            <option value="">
                    ...
            </option>
            @foreach ($jobs as $job)
                @if($job->parent_id == $child->id)

                    <option value="{{ $job->id }}">
                        {{ $job->name_tr }} : {{ $job->name_en}}
                    </option>

                        @endif
            @endforeach
        </select>
    </div>
       

    </template>
    @endif
    @endforeach
</div>

</x-layout>