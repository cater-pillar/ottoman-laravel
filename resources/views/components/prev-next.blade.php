@props(['id', 'position', 'arrow'])
@if ($id)
<a href={{ "/household/$id" }} 
    class="inline-block bg-blue-900 hover:bg-blue-600 text-white px-3 py-1 rounded absolute {{$position}}-0">
    {{ $arrow }}
 </a>    
@endif