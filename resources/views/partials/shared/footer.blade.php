<footer class="bg-gray-900 border-t-2 border-white text-white">
    <div class="max-w-7xl mx-auto px-4 py-8 md:px-0">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-sm text-center sm:text-left">
            <!-- Useful Links Column -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Useful Links</h2>
                <ul class="flex flex-col space-y-2">
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
                </ul>
            </div>
            
            <!-- Contact Us Column -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Contact Us</h2>
                <div class="flex flex-col space-y-2">
                    <p><strong>Email:</strong> <a href="mailto:hello@autisticled.com" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">hello@autisticled.com</a></p>
                    <p><strong>Phone:</strong> <a href="tel:07429145191" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">07429145191</a></p>
                </div>
            </div>

            <!-- Follow Us Column -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Follow Us</h2>
                <p>Social media links coming soon!</p>
            </div>

            <!-- Accessibility Column with Color Options -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Accessibility</h2>
                <p class="text-sm mb-4">Adjust the site’s appearance:</p>
                <div class="flex justify-start space-x-4">
                    <!-- Color Option Circles -->
                    <button class="w-8 h-8 rounded-full bg-yellow-500 hover:ring-2 hover:ring-yellow-500 focus:outline-none" title="Yellow"></button>
                    <button class="w-8 h-8 rounded-full bg-black hover:ring-2 hover:ring-yellow-500 focus:outline-none" title="Black"></button>
                    <button class="w-8 h-8 rounded-full bg-blue-500 hover:ring-2 hover:ring-yellow-500 focus:outline-none" title="Blue"></button>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center text-sm text-white">
            &copy; {{ date('Y') }} Autistic Led. All rights reserved.
            <div class="mt-2 text-white">
                Made with <span class="text-red-500">♥</span> by 
                <a href="https://ebrookes.dev" target="_blank" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">
                    Ellis Development
                </a>
            </div>
        </div>
    </div>
</footer>
