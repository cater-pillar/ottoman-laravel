@props(['id'])
@if ($id)
<a href={{ strpos(url()->full(), "?") ? "/household/$id" . substr(url()->full(), strpos(url()->full(), "?")) : "/household/$id" }} 
    class="inline-block bg-blue-900 hover:bg-blue-600 text-white p-2 rounded absolute left-0">
    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
    </svg>
 </a>    
@endif