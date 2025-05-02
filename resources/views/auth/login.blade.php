@extends('../partials.layout')

@section('title', 'Login')

@section('content')
    <div class="w-full max-w-md bg-gray-900 px-8 py-16 rounded-lg shadow-xl">
        <h2 class="text-2xl font-semibold text-yellow-500 mb-6 text-center">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block text-sm text-white">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label for="password" class="block text-sm text-white">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full p-3 mt-2 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-5">
                <label for="remember" class="flex items-center text-sm text-white">
                    <input type="checkbox" name="remember" id="remember" class="form-checkbox text-yellow-600">
                    <span class="ml-2">Remember me</span>
                </label>

                <!-- Forgot Password Link -->
                <a href="{{ route('password.request') }}" class="text-sm text-yellow-500 hover:underline">Forgot your password?</a>
            </div>

            <!-- Submit -->
            <div class="text-center mt-6">
                <button type="submit"
                    class="w-full py-3 bg-yellow-600 text-white rounded-md text-lg font-semibold hover:bg-yellow-500 transition duration-200">
                    Login
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <div class="text-center mt-6">
            <p class="text-sm text-gray-300">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-yellow-500 hover:underline">Register here</a>
            </p>
        </div>
    </div>
@endsection
