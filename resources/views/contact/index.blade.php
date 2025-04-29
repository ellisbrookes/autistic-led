@extends('partials.layout')

@section('content')
<div class="py-8 flex flex-col lg:flex-row justify-center px-4 space-x-8">
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

        <div class="text-white text-center sm:text-left space-y-4">
            <p><strong>Email:</strong> hello@autisticled.com</p>
            <p><strong>Phone:</strong> Coming soon!</p>
            
            <div class="w-full h-64 bg-gray-700 mt-4">
                <!-- Placeholder for map -->
                <p class="text-center text-white py-24">Map section (TBD)</p>
            </div>
        </div>
    </div>
</div>
@endsection