@props(['options', 'name', 'current'])
<td>
    <select id={{ $name }} name={{ $name }} >
         <option value="" disabled selected>
            {{ $current }}
        </option>
          @foreach ($options as $option)
          <option value{{ $option->id }} >
             {{ $option->name_tr }} 
          </option>
          @endforeach
    </select>
</td>