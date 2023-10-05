@props(['label', 'name', 'collection', 'alpine' => false])
<label for="{{ $name }}">
    {{ $label }}
</label>
<select name="{{ $name }}" id="{{ $name }}"
class="p-3 my-2 w-full text-gray-700 border 
      @error($name) border-red-500 @enderror"
@if($alpine) x-model="root" x-on:change="{{ $alpine }}" @endif
    >
    <option value="">...</option>
    @foreach ($collection as $item)
        <option value="{{ $item->id }}" @if( $item->id == request($name)) selected @endif>
            {{ $item->name_tr }}
        </option>
    @endforeach
</select>