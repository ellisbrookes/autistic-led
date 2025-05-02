@extends('../partials.layout')

@section('title', 'Verify Email')

@section('content')
    <div class="flex flex-col justify-center w-full max-w-md bg-gray-900 px-8 py-16 rounded-lg shadow-xl">
        <h2 class="text-2xl font-semibold text-yellow-500 mb-6 text-center">Email Verification</h2>

        <p class="text-sm text-gray-300 mb-6 text-center leading-relaxed">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?
            If you didn’t receive the email, we’ll gladly send you another.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-green-500 text-sm text-center font-semibold">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="flex flex-col sm:flex-row justify-center sm:justify-between items-center gap-4 mt-6">
            <!-- Resend Verification -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-3 bg-yellow-600 text-white rounded-md text-sm font-semibold hover:bg-yellow-500 transition duration-200">
                    Resend Verification Email
                </button>
            </form>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-sm text-yellow-400 hover:underline">
                    Log Out
                </button>
            </form>
        </div>
    </div>
@endsection
