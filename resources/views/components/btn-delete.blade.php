@props(['url'])
<form action={{ "/household/delete/" . $url }} method="POST">
    @csrf
    <input type="submit" value="Delete" class="inline-block bg-red-700 hover:bg-red-600 text-white py-2 px-2 mx-3 rounded w-20 text-sm text-center">
</form>