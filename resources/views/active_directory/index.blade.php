@extends('../partials.layout')

@section('content')
    <!-- Coming Soon Section -->
    <section class="flex-1 flex flex-col justify-center items-center text-center px-4">
        <h1 class="text-4xl sm:text-5xl font-bold text-yellow-500 mb-4">Coming Soon</h1>
        <p class="text-lg text-gray-300 mb-8 max-w-xl">We're working hard to bring you the Autistic Led Directory. Stay tuned!</p>

        <div x-data="countdownTimer()" class="text-2xl sm:text-3xl font-mono flex gap-6 text-white">
            <div class="text-center">
                <div x-text="days"></div>
                <span class="text-sm">Days</span>
            </div>
            <div class="text-center">
                <div x-text="hours"></div>
                <span class="text-sm">Hours</span>
            </div>
            <div class="text-center">
                <div x-text="minutes"></div>
                <span class="text-sm">Minutes</span>
            </div>
            <div class="text-center">
                <div x-text="seconds"></div>
                <span class="text-sm">Seconds</span>
            </div>
        </div>
    </section>
@endsection

<script>
    function countdownTimer() {
        const target = new Date("2025-06-01T00:00:00Z").getTime();
        return {
            days: '00', hours: '00', minutes: '00', seconds: '00',
            update() {
                const now = new Date().getTime();
                const distance = target - now;

                this.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                this.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                this.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
            },
            init() {
                this.update();
                setInterval(() => this.update(), 1000);
            }
        }
    }
</script>
