<!DOCTYPE html>
<html lang="en" x-data>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autistic Led - Homepage</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="text-white bg-gray-800 flex flex-col min-h-screen">

    <nav class="bg-gray-900 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/">
                    <img src="{{ asset('img/nav-logo.png') }}" alt="Logo" class="h-12 w-12 object-cover rounded-full">
                </a>

                <div class="hidden sm:flex space-x-6 items-center whitespace-nowrap text-base">
                    <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Home</a>
                    <a href="{{ url('about') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">About</a>
                    <a href="{{ route('contact') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Contact</a>
                    <a href="{{ url('what_we_offer') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">What We Offer</a>

                    <div x-data="{ open: false }" class="relative">
                        <button
                            @click="open = !open"
                            class="flex items-center space-x-1 text-white hover:text-yellow-600 hover:underline font-medium focus:outline-none"
                        >
                            <span>Autistic Led Directory</span>
                            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-transition
                            class="absolute left-0 mt-2 bg-gray-900 rounded-md shadow-lg z-50 w-max min-w-full"
                        >
                            <a href="{{ url('active_directory') }}" class="block px-6 py-3 text-sm text-white hover:text-yellow-600 hover:underline hover:bg-gray-900">Directory Home</a>
                            <a href="{{ route('active_directory.register') }}" class="block px-6 py-3 text-sm text-white hover:text-yellow-600 hover:underline hover:bg-gray-900">Register</a>
                            <a href="{{ route('active_directory.login') }}" class="block px-6 py-3 text-sm text-white hover:text-yellow-600 hover:underline hover:bg-gray-900">Login</a>
                        </div>
                    </div>
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

    <div id="mobile-menu" class="sm:hidden hidden bg-gray-700 text-white" x-data="{ mobileOpen: false }">
        <div class="flex flex-col items-center py-4 space-y-4 text-base text-center">
            <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Home</a>
            <a href="{{ url('about') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">About</a>
            <a href="{{ route('contact') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Contact</a>
            <a href="{{ url('what_we_offer') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">What We Offer</a>

            <button
                @click="mobileOpen = !mobileOpen"
                class="flex items-center justify-center space-x-1 text-white hover:text-yellow-600 hover:underline font-medium focus:outline-none"
            >
                <span>Autistic Led Directory</span>
                <svg :class="{ 'rotate-180': mobileOpen }" class="w-4 h-4 transition-transform transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="mobileOpen" x-transition class="w-full px-8 space-y-2">
                <a href="{{ url('active_directory') }}" class="block py-2 text-sm text-white hover:text-yellow-600 hover:underline hover:bg-gray-900 rounded">Directory Home</a>
                <a href="{{ route('active_directory.register') }}" class="block py-2 text-sm text-white hover:text-yellow-600 hover:underline hover:bg-gray-900 rounded">Register</a>
                <a href="{{ route('active_directory.login') }}" class="block py-2 text-sm text-white hover:text-yellow-600 hover:underline hover:bg-gray-900 rounded">Login</a>
            </div>
        </div>
    </div>

    <div class="sm:hidden border-t-2 border-white"></div>

    <section class="bg-gray-900 w-full flex flex-col items-center justify-center py-6">
        <img src="{{ asset('img/logo.png') }}" alt="Hero Logo" class="h-48 w-auto">
        <h1 class="text-white text-lg sm:text-xl font-light text-center px-4 tracking-wide mt-3">
            The journey may vary but it is always Autistic Led
        </h1>
    </section>

    <div class="border-t-2 border-white"></div>

    <main class="py-8 flex flex-1 justify-center">
        @yield('content')
        <h1>Content Coming Soon!</h1>
    </main>

    <footer class="bg-gray-900 mt-12 border-t-2 border-white">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 text-sm text-center sm:text-left">
                <div>
                    <h2 class="text-lg font-semibold mb-4">Useful Links</h2>
                    <ul class="space-y-2">
                        <li><a href="/" class="hover:text-yellow-600 hover:underline">Home</a></li>
                        <li><a href="{{ url('about') }}" class="hover:text-yellow-600 hover:underline">About</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-yellow-600 hover:underline">Contact</a></li>
                        <li><a href="{{ url('what_we_offer') }}" class="hover:text-yellow-600 hover:underline">What We Offer</a></li>
                        <li><a href="{{ url('active_directory') }}" class="hover:text-yellow-600 hover:underline">Autistic Led Directory</a></li>
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
