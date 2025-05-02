@extends('../partials.layout')

@section('title', 'Forgot Password')

@section('content')
    <div class="flex flex-col justify-center w-full max-w-md bg-gray-900 px-8 py-16 rounded-lg shadow-xl">
        <h2 class="text-2xl font-semibold text-yellow-500 mb-6 text-center">Forgot Password</h2>

        <p class="text-sm text-gray-300 mb-6 text-center leading-relaxed">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link so you can choose a new one.
        </p>

        @if (session('status'))
            <div class="mb-4 text-green-500 text-sm text-center font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-5">
                <label for="email" class="block text-sm text-white">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600" required autofocus>
                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="text-center mt-6">
                <button type="submit"
                    class="w-full py-3 bg-yellow-600 text-white rounded-md text-lg font-semibold hover:bg-yellow-500 transition duration-200">
                    Email Password Reset Link
                </button>
            </div>
        </form>
    </div>
@endsection
