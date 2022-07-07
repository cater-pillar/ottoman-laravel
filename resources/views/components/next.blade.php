@props(['id'])
@if ($id)
<a href={{ "/household/$id" }} 
    class="inline-block bg-blue-900 hover:bg-blue-600 text-white p-2 rounded absolute right-0">
    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
    </svg>
 </a>    
@endif