<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autistic Led - Homepage</title>
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
                    <a href="{{ route('contact') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Contact</a>
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">What We Offer</a>
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Autistic Led Directory</a>
                </div>
                <div class="sm:hidden flex items-center">
                    <button id="hamburger-icon" class="text-white focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="border-t-2 border-white"></div>
    </nav>

    <div id="mobile-menu" class="sm:hidden hidden bg-gray-700 text-white">
        <div class="flex flex-col items-center py-4 space-y-4">
            <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Home</a>
            <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">About</a>
            <a href="contact" class="text-white hover:text-yellow-600 hover:underline font-medium">Contact</a>
            <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">What We Offer</a>
            <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Autistic Led Directory</a>
        </div>
    </div>

    <div class="sm:hidden border-t-2 border-white"></div>

    <section class="bg-gray-900 w-full flex flex-col items-center justify-center py-6">
        <img src="{{ asset('img/logo.png') }}" alt="Hero Logo" class="h-48 w-auto">
        <h1 class="text-white text-base sm:text-lg font-light text-center px-4 tracking-wide mt-3">
            The journey may vary but it is always Autistic Led
        </h1>
    </section>

    <div class="border-t-2 border-white"></div>

    <main class="py-8 flex justify-center">
        @yield('content')
        <h1>Content Coming Soon!</h1>
    </main>

    <footer class="bg-gray-900 mt-12 border-t-2 border-white">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 text-sm text-center sm:text-left">
                <div>
                    <h2 class="text-lg font-semibold mb-4">Useful Links</h2>
                    <ul class="space-y-2">
                        <li><a href="/" class="hover:text-yellow-600">Home</a></li>
                        <li><a href="{{ url('/') }}" class="hover:text-yellow-600">About</a></li>
                        <li><a href="contact" class="hover:text-yellow-600">Contact</a></li>
                        <li><a href="{{ url('/') }}" class="hover:text-yellow-600">What We Offer</a></li>
                        <li><a href="{{ url('/') }}" class="hover:text-yellow-600">Autistic Led Directory</a></li>
                    </ul>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-4">Contact Us</h2>
                    <p>Email: hello@autisticled.com</p>
                    <p>Phone: Coming soon!</p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-4">Follow Us</h2>
                    <p>Social media links coming soon!</p>
                </div>
            </div>
    
            <div class="mt-8 text-center text-sm text-white">
                &copy; {{ date('Y') }} Autistic Led. All rights reserved.
                <div class="mt-2 text-white">
                    Made with <span class="text-red-500">♥</span> by 
                    <a href="https://ebrookes.dev" target="_blank" class="text-yellow-500 hover:underline font-medium">
                        Ellis Development
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('hamburger-icon').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>

</body>
</html>
