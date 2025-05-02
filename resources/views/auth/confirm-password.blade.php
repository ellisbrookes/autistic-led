@extends('../partials.layout')

@section('title', 'Confirm Password')

@section('content')
    <div class="flex flex-col justify-center w-full max-w-md bg-gray-900 px-8 py-16 rounded-lg shadow-xl">
        <h2 class="text-2xl font-semibold text-yellow-500 mb-6 text-center">Confirm Password</h2>

        <p class="text-sm text-gray-300 mb-6 text-center leading-relaxed">
            This is a secure area of the application. Please confirm your password before continuing.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block text-sm text-white">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600"
                    required autocomplete="current-password">
                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="text-center mt-6">
                <button type="submit"
                    class="w-full py-3 bg-yellow-600 text-white rounded-md text-lg font-semibold hover:bg-yellow-500 transition duration-200">
                    Confirm
                </button>
            </div>
        </form>
    </div>
@endsection
