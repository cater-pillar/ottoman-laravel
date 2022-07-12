@props(['label', 'name', 'collection'])
<label for="{{ $name }}">
    {{ $label }}
</label>
<select name="{{ $name }}" id="{{ $name }}"
class="p-3 my-2 w-full text-gray-700 border @error('{{ $name }}') border-red-500 @enderror"
    >
    @foreach ($collection as $item)
        <option value="{{ $item->id }}">
            {{ $item->name_tr }}
        </option>
    @endforeach
</select>