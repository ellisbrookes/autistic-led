<nav class="bg-gray-900 shadow-md border-b-2 border-white">
    <div class="max-w-7xl mx-auto px-4 md:px-0">
        <div class="flex justify-between items-center h-16">
            <a href="/">
                <img src="{{ asset('img/nav-logo.png') }}" alt="Logo" class="h-12 w-12 object-cover rounded-full">
            </a>

            <div class="hidden sm:flex space-x-6 items-center whitespace-nowrap text-base">
                <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                    {{ __('About') }}
                </x-nav-link>
                <x-nav-link :href="route('services')" :active="request()->routeIs('services')">
                    {{ __('Services') }}
                </x-nav-link>
                <x-nav-link :href="route('active_directory')" :active="request()->routeIs('active_directory')">
                    {{ __('Active Directory') }}
                </x-nav-link>
                <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                    {{ __('Contact') }}
                </x-nav-link>
                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-nav-link>
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
        <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
            {{ __('About') }}
        </x-nav-link>
        <x-nav-link :href="route('services')" :active="request()->routeIs('services')">
            {{ __('Services') }}
        </x-nav-link>
        <x-nav-link :href="route('active_directory')" :active="request()->routeIs('active_directory')">
            {{ __('Active Directory') }}
        </x-nav-link>
        <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
            {{ __('Contact') }}
        </x-nav-link>
        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
            {{ __('Login') }}
        </x-nav-link>
    </div>
</div>

<script>
    document.getElementById('hamburger-icon').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>