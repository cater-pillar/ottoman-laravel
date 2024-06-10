@props(['request'])

<!-- I need to find a way to make this work -->
@if ($request->count() > 0)
    <div>
        @foreach ($request as $key => $value)
            @switch($key)
                @case(str_contains($key, 'need-different-approach'))
                        <div>Location is {{ str_replace('locations_any_', '', $key) }}</div>
                    @break
                @case(2)
                    
                    @break
                @default
                    
            @endswitch
        @endforeach
    </div>
@endif
