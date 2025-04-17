<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autistic Led</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-white">

    <nav class="bg-black shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16"> 
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('img/nav-logo.png') }}" alt="Logo" class="h-12 w-12 object-cover rounded-full">
                </div>

                <div class="hidden sm:flex space-x-8">
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Home</a>
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">About</a>
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Contact</a>
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">What We Offer</a>
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Autistic Led Directory</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8 flex justify-center">
        @yield('content')
        <img src="{{ asset('img/logo.png') }}" alt="Hero Image" class="mx-auto mt-8 h-60 w-auto">
    </main>

</body>
</html>
