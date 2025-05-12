@extends('partials.layout')

@section('title', 'Contact Us')

@section('content')
<div class="max-w-7xl px-4 md:space-x-8 space-y-4 md:space-y-0 md:flex md:px-0 w-full">
    <!-- Contact Form -->
    <div class="w-full lg:w-1/2 space-y-6">
        <h2 class="text-2xl font-semibold text-center text-white">Contact Us</h2>

        <form action="" method="POST" class="space-y-4">
            @csrf

            <div class="flex flex-col">
                <label for="name" class="text-white">Name</label>
                <input type="text" name="name" id="name" class="p-3 bg-gray-700 text-white rounded" required>
            </div>

            <div class="flex flex-col">
                <label for="email" class="text-white">Email</label>
                <input type="email" name="email" id="email" class="p-3 bg-gray-700 text-white rounded" required>
            </div>

            <div class="flex flex-col">
                <label for="message" class="text-white">Message</label>
                <textarea name="message" id="message" rows="6" class="p-3 bg-gray-700 text-white rounded" required></textarea>
            </div>

            <button type="submit" class="w-full py-3 bg-yellow-600 text-black font-semibold rounded hover:bg-yellow-500">
                Send Message
            </button>
        </form>
    </div>

    <div class="w-full lg:w-1/2 space-y-6">
        <h2 class="text-2xl font-semibold text-center text-white">Our Contact Information</h2>

        <div class="flex flex-col text-white text-center sm:text-left space-y-4">
            <div class="md:flex justify-between">
                <p><strong>Email:</strong> <a href="mailto:hello@autisticled.com" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">hello@autisticled.com</a></p>
                <p><strong>Phone:</strong> <a href="tel:07429145191" class="hover:underline hover:decoration-yellow-500 hover:decoration-wavy hover:decoration-2">07429145191</a></p>
            </div>
            
            <div class="w-full h-64 bg-gray-700 mt-4">
                <!-- Placeholder for map -->
                <p class="text-center text-white py-24">Map section (TBD)</p>
            </div>
        </div>
    </div>
</div>
@endsection