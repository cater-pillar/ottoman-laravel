@if(session()->has('success'))
    <div class="bg-green-700 p-3 text-white" 
        x-data="{ show:true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 3000)"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="transform origin-top scale-y-100"
        x-transition:leave-end="transform origin-top scale-y-0">
        {{ session()->get('success') }}
    </div>
@endif