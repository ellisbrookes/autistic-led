@extends('../partials.layout')

@section('title') Post - {{ $post['title'] }} @endsection

@section('content')
    <div class="flex max-w-7xl">
        <h1 class="text-4xl font-bold text-yellow-400 mb-6">{{ $post['title'] }}</h1>
        <p class="text-gray-400 mb-6">{{ $post['content'] }}</p>
        <a href="{{ route('forums.category', ['slug' => 'general-discussion']) }}" class="text-sm text-yellow-500 hover:underline">Back to Category</a>

        <!-- Comments Section -->
        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-white mb-4">Comments ({{ count($post['comments']) }})</h2>

            @foreach ($post['comments'] as $comment)
                <div class="bg-white/10 rounded-lg p-6 mb-4">
                    <div class="flex items-start">
                        <!-- Avatar (Placeholder) -->
                        <div class="w-12 h-12 rounded-full bg-gray-500 mr-4 flex-shrink-0"></div>

                        <div class="flex-1">
                            <!-- Comment Author and Date -->
                            <div class="text-yellow-400 font-semibold">{{ $comment['author'] }}</div>
                            <div class="text-sm text-gray-500">{{ $comment['date'] }}</div>

                            <!-- Comment Content -->
                            <p class="mt-2 text-white">{{ $comment['content'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Add a New Comment -->
            <div class="bg-white/10 rounded-lg p-6 mt-8">
                <h3 class="text-lg font-semibold text-white mb-4">Add a Comment</h3>
                <form action="#" method="POST">
                    @csrf
                    <textarea class="w-full p-4 bg-gray-700 text-white rounded-lg" rows="4" placeholder="Write your comment here..."></textarea>
                    <button type="submit" class="mt-4 bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-400 transition">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
