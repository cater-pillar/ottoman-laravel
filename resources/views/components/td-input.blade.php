@props(['name', 'value'])
<td>
    <input type="text" id={{ $name }} name={{ $name }} 
           placeholder={{ $value }}
           value={{ $value }} >
</td>