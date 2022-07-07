@props(['options', 'name', 'current', 'colspan' => 1])
<td colspan={{ $colspan }}>
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