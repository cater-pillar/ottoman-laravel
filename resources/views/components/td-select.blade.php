@props(['options', 'name', 'current', 'colspan' => 1, 'index' => null])
<td class="border" colspan={{ $colspan }}>
    <select id={{ $index ? $name . (++$index) : $name }} 
            name={{ $index ? $name . $index : $name }} 
            class="p-3 w-full bg-transparent 
            @error($name) border border-red-500 @enderror"
    >
         <option value="{{ $current->id }}" selected>
            {{ $current->name_tr }}
        </option>
          @foreach ($options as $option)
          <option value={{ $option->id }} >
             {{ $option->name_tr }} 
          </option>
          @endforeach
    </select>
</td>