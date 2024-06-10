@props(['label','collection' => collect([]), 'type'])
@if ($collection->count() > 0 && !$type)
<div class="overflow-auto max-h-96">
@foreach ($collection as $index => $item)
    <div class="py-1 pl-4 hover:bg-gray-700 hover:text-gray-300 relative">
        <input type="checkbox" 
            name="{{ $label .'_'. $item->id }}" 
            id="{{ $label .'_'. $item->id }}"
            value="{{$item->id}}"  
            class="absolute left-2 top-2"
            x-model="tempData.refKeys">
        <label for="{{ $label .'_'. $item->id }}" 
                class="inline-block w-full pl-2">
            {{ $item->name_tr . " (" . $item->name_en . ")" }}
        </label>
    </div>
@endforeach
</div>
@endif