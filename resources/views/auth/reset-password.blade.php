@extends('../partials.layout')

@section('title', 'Reset Password')

@section('content')
    <div class="flex flex-col justify-center w-full max-w-md bg-gray-900 px-8 py-16 rounded-lg shadow-xl">
        <h2 class="text-2xl font-semibold text-yellow-500 mb-6 text-center">Reset Password</h2>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block text-sm text-white">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}"
                    class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600" required autofocus>
                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block text-sm text-white">New Password</label>
                <input type="password" name="password" id="password"
                    class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-5">
                <label for="password_confirmation" class="block text-sm text-white">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center mt-6">
                <button type="submit"
                    class="w-full py-3 bg-yellow-600 text-white rounded-md text-lg font-semibold hover:bg-yellow-500 transition duration-200">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
@endsection
