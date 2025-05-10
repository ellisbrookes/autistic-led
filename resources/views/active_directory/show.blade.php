@extends('../partials.layout')

@section('title', 'Business Details')

@section('content')
<div class="max-w-7xl mx-auto text-white">

    <div class="flex items-center justify-between gap-6 mb-8 flex-wrap">
        <div class="flex items-center gap-6">
            <img src="/img/ellis.png" alt="Ellis Development Logo" class="w-24 h-24 rounded-full object-cover border border-yellow-400">
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="text-4xl font-bold text-yellow-400">Ellis Development</h1>
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414L9 13.414l4.707-4.707z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-gray-400 mt-2">Coming soon!</p>
            </div>
        </div>
        <a href="#" class="mt-4 lg:mt-0 px-5 py-2 bg-yellow-400 text-black rounded-md hover:bg-yellow-300">
            Edit
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div x-data="slideshow()" class="relative col-span-1 lg:col-span-2 overflow-hidden rounded-xl border border-white/10">
            <template x-for="(image, index) in images" :key="index">
                <div x-show="current === index" class="transition-all duration-500">
                    <img :src="image" alt="" class="w-full h-72 object-cover">
                </div>
            </template>
            <button @click="prev()" class="absolute left-2 top-1/2 -translate-y-1/2 text-white bg-black/40 rounded-full px-3 py-1 hover:bg-black/60">‹</button>
            <button @click="next()" class="absolute right-2 top-1/2 -translate-y-1/2 text-white bg-black/40 rounded-full px-3 py-1 hover:bg-black/60">›</button>
        </div>
        
        <div class="flex flex-col justify-between">
            <div class="bg-white/5 p-6 rounded-lg border border-white/10 shadow-lg">
                <h2 class="text-xl font-semibold text-yellow-400 mb-2">Contact Info</h2>
                <ul class="space-y-2 text-sm mb-6">
                    <li><strong>Address:</strong> 119 Atherton Gardens, Spalding, Lincolnshire, PE11 3YJ</li>
                    <li><strong>Email:</strong> <a href="mailto:hello@ebrookes.dev" class="text-yellow-400 hover:underline">hello@ebrookes.dev</a></li>
                    <li><strong>Website:</strong> <a href="https://ebrookes.dev" target="_blank" class="text-yellow-400 hover:underline">ebrookes.dev</a></li>
                </ul>
                <h2 class="text-xl font-semibold text-yellow-400 mb-2">Opening Hours</h2>
                <ul class="space-y-1 text-sm text-gray-300">
                    <l>Monday – Sunday : 24HR </l
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-semibold text-yellow-400 mb-2">About</h2>
        <p class="text-gray-300 leading-relaxed">
            Coming soon!
        </p>
    </div>
</div>

<script>
function slideshow() {
    return {
        current: 0,
        images: [
            '/img/ellis.png',
            '/img/ellis.png',
            '/img/ellis.png',
        ],
        next() {
            this.current = (this.current + 1) % this.images.length;
        },
        prev() {
            this.current = (this.current - 1 + this.images.length) % this.images.length;
        }
    }
}
</script>
@endsection
