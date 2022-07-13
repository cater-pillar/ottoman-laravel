@props(['name', 'value' => 0, 'colspan' => 1, 'index' => null, 'type' => 'text'])
<td class="border" 
    colspan={{ $colspan }}>
    <input  type={{ $type }} 
            id={{ $index ? $name . (++$index) : $name }} 
            name={{ $index ? $name . $index : $name }} 
            value="{{ $value }}"
            class="p-3 w-full @error($name) border border-red-500 @enderror"
            @if ($type === "number")
                min="0"
            @endif
           >       
</td>