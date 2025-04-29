<nav class="bg-gray-900 shadow-md border-b-2 border-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="/">
                <img src="{{ asset('img/nav-logo.png') }}" alt="Logo" class="h-12 w-12 object-cover rounded-full">
            </a>

            <div class="hidden sm:flex space-x-6 items-center whitespace-nowrap text-base">
                <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Home</a>
                <a href="{{ url('about') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">About</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Contact</a>
                <a href="{{ url('services') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Services</a>

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
</nav>

<div id="mobile-menu" class="sm:hidden hidden bg-gray-700 text-white border-b-2 border-white" x-data="{ mobileOpen: false }">
    <div class="flex flex-col items-center py-4 space-y-4 text-base text-center">
        <a href="{{ url('/') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Home</a>
        <a href="{{ url('about') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">About</a>
        <a href="{{ route('contact') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Contact</a>
        <a href="{{ url('services') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Services</a>

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

<script>
    document.getElementById('hamburger-icon').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>