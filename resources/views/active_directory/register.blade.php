@extends('../partials.layout')

@section('content')
    <div class="flex flex-col justify-center w-full max-w-md bg-gray-900 px-8 py-16 rounded-lg shadow-xl">
        <h2 class="text-2xl font-semibold text-yellow-500 mb-6 text-center">Register</h2>

        <form action="{{ route('active_directory.register') }}" method="POST">
            @csrf

            <div class="mb-5">
                <label for="name" class="block text-sm text-white">Name</label>
                <input type="text" name="name" id="name" class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            </div>

            <div class="mb-5">
                <label for="email" class="block text-sm text-white">Email</label>
                <input type="email" name="email" id="email" class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            </div>

            <div class="mb-5">
                <label for="password" class="block text-sm text-white">Password</label>
                <input type="password" name="password" id="password" class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="block text-sm text-white">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="w-full py-3 bg-yellow-600 text-white rounded-md text-lg font-semibold hover:bg-yellow-500 transition duration-200">Register</button>
            </div>
        </form>
    </div>
@endsection
