@props(['label', 'name', 'placeholder', 'type' => 'text'])
<label for="number">
    {{ $label }}
</label>
<input  type="{{ $type }}" 
id="{{ $name }}" 
name="{{ $name }}" 
placeholder="{{ $placeholder }}"
@if (session($name))
value={{session($name)}}
@endif
class="p-3 my-2 w-full text-gray-700 border @error('number') border-red-500 @enderror"
@if ($type === "number")
    min="0"
@endif
> 