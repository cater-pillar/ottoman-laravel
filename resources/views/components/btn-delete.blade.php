@props(['url'])

<div x-data="{ modalOpen: false, }">

    <button @click="modalOpen = true"
    class="inline-block bg-red-700 hover:bg-red-600 text-white py-2 px-2 mx-3 rounded w-20 text-sm text-center">Delete</button>
    <div x-cloak x-show="modalOpen" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="relative box w-2/3 bg-gray-100 mx-auto my-20 p-10 rounded shadow-sm">
                <div class="p-8 text-center">
                    <h2 class="text-lg font-bold mb-4">Delete Household</h2>
                    <p class="mb-8">Are you sure you want to permanently delete household?</p>
                    <div class="mx-auto w-fit">
                        <form action={{ "/household/delete/" . $url }} method="POST" class="inline">
                            @csrf
                            <input type="submit" value="Delete" class="inline-block bg-red-700 hover:bg-red-600 text-white py-2 px-2 mx-3 rounded w-20 text-sm text-center">
                        </form>
                        <button @click="modalOpen = false" class="inline-block bg-green-700 hover:bg-green-600 text-white py-2 px-2 mx-3 rounded w-20 text-sm text-center">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
