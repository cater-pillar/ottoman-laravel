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
        @if ($item->children()->count() === 0)
            <option value="{{ $item->id }}"
                @if ($item->id == session('location'))
                    selected
                @endif
                >
                {{ $item->name_tr . " " . $item->locationType->name_tr . " (" . $item->locationName->name_tr . " " . $item->locationName->locationType->name_tr . ")"}}
            </option>
        @endif
    @endforeach
</select>