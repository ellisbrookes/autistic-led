@extends('../partials.layout')

@section('title', 'Forums')

@section('content')
    <div class="w-full px-8 py-10">
        <h1 class="text-4xl font-bold text-yellow-400 mb-2">Forum Categories</h1>
        <p class="text-gray-400 mb-6 text-lg">Select a category to see what people are talking about.</p>

        <div class="space-y-4">
            @foreach ($categories as $slug => $category)
                <a href="{{ route('forums.category', $slug) }}"
                   class="block bg-white/10 rounded-lg p-4 hover:shadow-md transition">
                    <div class="flex items-center space-x-4">
                        <i class="{{ $category['icon'] }} text-2xl text-yellow-400"></i>
                        <div>
                            <h2 class="text-lg text-white font-semibold">{{ $category['name'] }}</h2>
                            <p class="text-sm text-gray-400">{{ $category['description'] }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
