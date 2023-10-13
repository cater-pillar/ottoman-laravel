@props(['label','collection'])

<div class="border p-2">
    <p>
        {{$label}}
    </p>
    @foreach ($collection as $index => $item)

        <input type="checkbox" name="{{ $label .'_'. $item->id }}" id="{{ $label .'_'. $item->id }}">
        <label for="{{ $label .'_'. $item->id }}">
            {{ $item->name_tr . " (" . $item->name_en . ")" }}
        </label>

    @endforeach
</div>


