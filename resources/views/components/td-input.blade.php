@props(['name', 'value', 'colspan' => 1])
<td colspan={{ $colspan }}>
    <input type="text" id={{ $name }} name={{ $name }} 
           placeholder="{{ $value }}"
           value="{{ $value }}" >
</td>