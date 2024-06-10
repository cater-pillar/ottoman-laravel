@props(['label','type'])
@if ($type === "text" || $type === "number")
<input type="{{$type}}" 
       name="{{ $label }}" 
       id="{{ $label }}"  
       class="py-1 px-2 m-2 text-gray-700 outline-blue-700"
       placeholder="{{$type}}"
       x-model="tempData.input">
@endif