<footer class="bg-gray-900 border-t-2 border-white text-white">
    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 text-sm text-center sm:text-left">
            <div>
                <h2 class="text-lg font-semibold mb-4">Useful Links</h2>
                <ul class="space-y-2">
                    <li><a href="/" class="hover:text-yellow-600 hover:underline">Home</a></li>
                    <li><a href="{{ url('about') }}" class="hover:text-yellow-600 hover:underline">About</a></li>
                    <li><a href="{{ url('contact') }}" class="hover:text-yellow-600 hover:underline">Contact</a></li>
                    <li><a href="{{ url('services') }}" class="hover:text-yellow-600 hover:underline">Services</a></li>
                    <li><a href="{{ url('active_directory') }}" class="hover:text-yellow-600 hover:underline">Active Directory</a></li>
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