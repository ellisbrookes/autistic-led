@extends('../partials.layout')

@section('title', 'Business Directory')

@section('content')
<div x-data="categorySidebar()" class="flex h-screen w-full overflow-hidden text-white">
    <aside class="w-64 flex-shrink-0 px-6 py-8 space-y-6 bg-white/5 backdrop-blur-sm border-r border-white/10">
        <div>
            <h2 class="text-lg font-semibold text-yellow-400 mb-4 tracking-tight">Categories</h2>
            <nav class="flex flex-col gap-2">
                <template x-for="(category, index) in categories" :key="index">
                    <button
                        @click="toggleCategory(category)"
                        class="text-left px-4 py-2 rounded-lg transition-all duration-150 font-medium"
                        :class="selected.includes(category)
                            ? 'bg-yellow-400 text-black shadow-sm'
                            : 'hover:bg-yellow-500/10 text-white'"
                    >
                        <span x-text="category"></span>
                    </button>
                </template>
            </nav>
        </div>

        <div x-show="selected.length">
            <button
                @click="selected = []"
                class="text-xs text-gray-400 hover:text-yellow-400 underline transition"
            >
                Clear filters
            </button>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 px-10 py-10 overflow-y-auto">
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-yellow-400 mb-2">Business Directory</h1>
            <p class="text-gray-400">Use the category filters to refine your search.</p>
        </header>

        <!-- Selected Categories -->
        <section class="mb-6">
            <template x-if="selected.length">
                <div class="flex flex-wrap gap-2">
                    <template x-for="category in selected" :key="category">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-yellow-400 text-black text-sm">
                            <span x-text="category"></span>
                            <button
                                class="ml-2 text-black hover:text-gray-800"
                                @click="toggleCategory(category)"
                            >
                                &times;
                            </button>
                        </span>
                    </template>
                </div>
            </template>
            <template x-if="selected.length === 0">
                <p class="text-sm text-gray-500 italic">No filters selected.</p>
            </template>
        </section>

        <!-- Placeholder Content -->
        <div class="mt-8 border-t border-white/10 pt-6 text-gray-400">
            <p>Filtered business listings will appear here.</p>
        </div>
    </main>
</div>

<script>
function categorySidebar() {
    return {
        categories: [
            'Restaurants', 'Hair Salons', 'Gyms', 'Retail',
            'Healthcare', 'Automotive', 'Entertainment', 'Education',
        ],
        selected: [],
        toggleCategory(cat) {
            if (this.selected.includes(cat)) {
                this.selected = this.selected.filter(c => c !== cat);
            } else {
                this.selected.push(cat);
            }
        }
    }
}
</script>
@endsection
