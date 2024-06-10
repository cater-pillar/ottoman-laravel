@props(['label','collection' => collect([]), 'options', 'type' => null])
<template x-if="filter ==='{{ $label }}'">
    <div class="relative">
        <span class="inline-block m-2 font-bold">{{ $label }}</span>
        <span class="select-none cursor-pointer inline-block px-3 py-1 rounded-full hover:bg-gray-200 font-bold absolute top-1 right-1"
              x-on:click="filter = null">
        X</span><br>
        <select class="p-1 m-2 text-gray-700 outline-blue-700" 
                name="{{$label . "_logic"}}" 
                id="{{$label . "_logic"}}"
                x-model="tempData.logic">
            @foreach ($options as $option)
                <option value="{{$option}}">{{$option}}</option>
            @endforeach
        </select>
        <x-filter_selfref label='{{ $label }}' :collection="$collection" :type="$type"/>
        <x-filter_check label='{{ $label }}' :collection="$collection" :type="$type"/>
        <x-filter_radio label='{{ $label }}' :collection="$collection" :type="$type"/>
        <x-filter_input label='{{ $label }}' :type="$type"/>
        <div  class="hover:bg-gray-200 text-blue-700 m-2 p-2 rounded text-sm font-bold float-right inline-block" 
              x-on:click="tempData.name = '{{ $label }}'; search.push({...tempData}); open = false; filter=''">Apply
        </div>
    </div>
</template>