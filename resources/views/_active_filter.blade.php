@foreach(collect(request()) as $key => $value)  
@if (str_contains($key, 'location'))
    <div>Location is {{ $value }}</div>
@endif  
    <div> {{$key . "/" . $value}} </div>
@endforeach 