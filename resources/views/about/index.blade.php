<!DOCTYPE html>
<html lang="en" x-data>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autistic Led - About Us</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="text-white bg-gray-800 flex flex-col min-h-screen">

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
    </nav>

    <div id="mobile-menu" class="sm:hidden hidden bg-gray-700 text-white border-b-2 border-white" x-data="{ mobileOpen: false }">
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

    <section class="bg-gray-900 flex flex-col items-center p-4 border-b-2 border-white">
        <img src="{{ asset('img/logo.png') }}" alt="Hero Logo" class="h-34">

        <h1 class="text-white text-lg sm:text-xl tracking-wide my-4">
            The journey may vary but it is always Autistic Led
        </h1>
    </section>

    <main class="p-4 flex items-center justify-center flex-1 flex-col">
        <div class="container md:w-4xl flex flex-col gap-3">
            <p>Autistic Led is an autistic adult peer support group that started in 2018 and covers the South Holland area of Lincolnshire, UK.</p>

            <p>We have Thursday in-person groups at Polka Dot Studios (AKA The Umbrella) with the address as follows: Westlode Street, Spalding, PE11 2AE.</p>

            <p>But that's not where it ends!</p>

            <p>You see, at Autistic Led, it's all about meeting your own communication preferences as much as possible. So we have group chats on Whatsapp and Facebook as well as outdoor meet-ups. 
            We are always thinking about new ways to bring the community closer together, specifically our autistic community but also the wider community through events so check back on the What We Offer page or follow us on Facebook</p>

            <p>A LITTLE ABOUT ME</p>

            <p>My name is Callum Brazzo and I am an autistic adult with OCD and Tourette's, diagnosed at 21 after my alternative journey through mainstream education. Poetry was and still is my most consistent communication tool and I wouldn't be here without it!</p>

            <p>I hope that people that connect with Autistic Led can find healthy outlets for their own expression as our journeys vary... 6 years on, we are still going strong</p>

            <p>Wanna know more?</p>
            <p>Contact me on 07429 145 191 or email hello@autisticled.com and I'll get back to you when I can!</p>

            <p>The journey may vary but it is always Autistic Led.</p>
        </div>
    </main>

    <footer class="bg-gray-900 border-t-2 border-white">
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
