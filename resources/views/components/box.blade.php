@props(['title','label','collection'])
<div class="border p-2 bg-gray-100 mb-3" 
        @if(collect(request()->keys())
             ->filter(fn($key) => str_contains($key, $label) && $key)
             ->count() > 0)
            x-data="{open:true}"
        @else
            x-data="{open:false}"
        @endif 
    >
    <p class="p-1 m-1 font-bold" x-on:click="open = ! open">
        {{$title}}
    </p>
    <div x-cloak x-show="open" @include("_transition")>
        @foreach ($collection as $index => $item)
            <div class="inline-block p-1 m-1 border max-w-fit rounded bg-white" 
                @if(request($label .'_'. $item->id))
                    x-data="{checked:true}"
                @else
                    x-data="{checked:false}"
                @endif
                :class="checked ? 'bg-blue-300' : ''" >
            <input type="checkbox" 
                name="{{ $label .'_'. $item->id }}" 
                id="{{ $label .'_'. $item->id }}" 
                x-model="checked" 
                class="hidden"
                >
            <label for="{{ $label .'_'. $item->id }}" class="select-none">
                {{ $item->name_tr . " (" . $item->name_en . ")" }}
            </label>
            </div>
         @endforeach
         {{-- @if ($label == "real_estates" || $label == "lands")       
         <x-input name="{{$label.'_description'}}" label='' placeholder="search description text..." />
         <x-input name="{{$label.'_location'}}" label='' placeholder="search location text..." />
         @endif --}}
    </div>
</div>


