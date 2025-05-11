@extends('../partials.layout')

@section('title', 'Category - ' . $category['name'])

@section('content')
    <div class="md:flex max-w-7xl w-full mx-auto">
        <div class="flex flex-col w-full">
            <h1 class="text-4xl font-bold text-yellow-400 mb-6">{{ $category['name'] }}</h1>
            <p class="text-gray-400 mb-6">{{ $category['description'] }}</p>
            <a href="{{ route('forums.test') }}" class="text-sm text-yellow-500 hover:underline">Back to all categories</a>

            <div class="space-y-4 mt-8">
                @foreach ($category['posts'] as $post)
                    <a href="{{ route('forums.post', ['slug' => $category['slug'], 'id' => $post['id']]) }}" class="block bg-white/10 rounded-lg p-4 hover:shadow-md transition">
                        <h2 class="text-lg text-white font-semibold">{{ $post['title'] }}</h2>
                        <p class="text-sm text-gray-400">{{ $post['excerpt'] }}</p>
                        <span class="text-xs text-gray-500">Comments: {{ $post['comments_count'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
