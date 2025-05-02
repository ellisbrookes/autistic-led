<footer class="bg-gray-900 border-t-2 border-white text-white">
    <div class="max-w-7xl mx-auto px-4 py-8 md:px-0">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 text-sm text-center sm:text-left">
            <div>
                <h2 class="text-lg font-semibold mb-4">Useful Links</h2>
                <ul class="space-y-2">
                    <li><a href="{{ url('about') }}" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">About</a></li>
                    <li><a href="{{ url('services') }}" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">Services</a></li>
                    <li><a href="{{ url('active_directory') }}" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">Active Directory</a></li>
                    <li><a href="{{ url('contact') }}" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">Contact</a></li>
                    <li><a href="{{ url('login') }}" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">Login</a></li>
                </ul>
            </div>
            <div>
                <h2 class="text-lg font-semibold mb-4">Contact Us</h2>
                <p><strong>Email:</strong> <a href="mailto:hello@autisticled.com" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">hello@autisticled.com</a></p>
                <p><strong>Phone:</strong> <a href="tel:07429145191" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">07429145191</a></p>
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
                <a href="https://ebrookes.dev" target="_blank" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">
                    Ellis Development
                </a>
            </div>
        </div>
    </div>
</footer>