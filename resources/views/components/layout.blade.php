<!DOCTYPE html>
<html>
    <head>
        <title>Prikaz baze podataka</title>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            [x-cloak] { display: none !important; }
        </style>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <nav class="bg-blue-900 text-white shadow-lg">
            <ul>
                <li class="inline-block">
                    <a href='/' 
                       class='inline-block hover:bg-blue-700 p-5'>
                       Home
                    </a>
                </li>
                <li class="inline-block">
                    <a href='/household/create' 
                       class='inline-block hover:bg-blue-700 p-5'>
                       Add Household
                    </a>
                </li>
                <li class="inline-block">
                    <a href='/occupations' 
                       class='inline-block hover:bg-blue-700 p-5'>
                       Occupations
                    </a>
                </li>
                <li class="inline-block">
                    <a href='/lands' 
                       class='inline-block hover:bg-blue-700 p-5'>
                       Lands
                    </a>
                </li>
                <li class="inline-block">
                    <a href='/realestates' 
                       class='inline-block hover:bg-blue-700 p-5'>
                       Real Estates
                    </a>
                </li>
                <li class="inline-block">
                    <a href='/taxes' 
                       class='inline-block hover:bg-blue-700 p-5'>
                       Taxes
                    </a>
                </li>
                <li class="inline-block">
                    <a href='/households' 
                       class='inline-block hover:bg-blue-700 p-5'>
                       All Households
                    </a>
                </li>
                <li class="inline-block">
                    <a href='#' 
                       class='inline-block hover:bg-blue-700 p-5'>
                       Search
                    </a>
                </li>
            </ul>
        </nav>
        <div class="container mx-auto my-20 bg-white p-10 rounded shadow-sm">
            {{ $slot }}
        </div>
    </body>
</html>