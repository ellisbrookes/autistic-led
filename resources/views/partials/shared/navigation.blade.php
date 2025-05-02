<nav class="bg-gray-900 shadow-md border-b-2 border-white">
    <div class="max-w-7xl mx-auto px-4 md:px-0">
        <div class="flex justify-between items-center h-16">
            <a href="/">
                <img src="{{ asset('img/nav-logo.png') }}" alt="Logo" class="h-12 w-12 object-cover rounded-full">
            </a>

            <div class="hidden sm:flex space-x-6 items-center whitespace-nowrap text-base">
                <a href="{{ url('about') }}" class="text-white hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">About</a>
                <a href="{{ url('services') }}" class="text-white hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">Services</a>
                <a href="{{ url('active_directory') }}" class="text-white hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">Active Directory</a>
                <a href="{{ url('contact') }}" class="text-white hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">Contact</a>
                <a href="{{ route('login') }}" class="text-white hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">Login</a>
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
        <a href="{{ url('about') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">About</a>
        <a href="{{ url('services') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Services</a>
        <a href="{{ url('active_directory') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Active Directory</a>
        <a href="{{ url('contact') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Contact</a>
        <a href="{{ url('login') }}" class="text-white hover:text-yellow-600 hover:underline font-medium">Login</a>
    </div>
</div>

<script>
    document.getElementById('hamburger-icon').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>