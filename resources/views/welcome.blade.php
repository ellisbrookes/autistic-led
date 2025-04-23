<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autistic Led</title>
    @vite('resources/css/app.css')
</head>
<body class="text-white bg-gray-800">

    <nav class="bg-gray-900 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16"> 
                <div class="flex items-center space-x-4">
                    <a href="/">
                        <img src="{{ asset('img/nav-logo.png') }}" alt="Logo" class="h-12 w-12 object-cover rounded-full">
                    </a>
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

    <div class="border-t-2 border-white"></div>

    <div class="bg-gray-800 bg-opacity-80 w-full flex flex-col items-center justify-center py-2">
        <div class="w-full h-full flex flex-col items-center justify-center">
            <img src="{{ asset('img/logo.png') }}" alt="Hero Logo" class="h-48 w-auto">

            <h1 class="text-white text-base sm:text-lg font-light text-center px-4 tracking-wide mt-3">
                The journey may vary but it is always Autistic Led
            </h1>
        </div>
    </div>

    <div class="border-t-2 border-white"></div>

    <main class="py-8 flex justify-center">
        @yield('content')
    </main>

</body>
</html>
