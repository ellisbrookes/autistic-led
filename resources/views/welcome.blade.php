<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autistic Led</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-black">

    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="h-14 w-14">
                    <div class="hidden sm:-my-px sm:ml-10 sm:flex space-x-4">
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Home</a>
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">About</a>
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">Contact</a>
                        <a href="{{ url('/') }}" class="text-gray-700 hover:text-gray-900">What we offer</a></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-8">
        @yield('content')
    </main>

</body>
</html>
