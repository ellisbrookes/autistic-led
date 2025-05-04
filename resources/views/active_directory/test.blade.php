@extends('../partials.layout')

@section('title', 'Active Directory')

@section('content')
<div x-data="categorySidebar()" class="md:flex max-w-7xl w-full mx-auto">
    <aside class="px-6 py-8 space-y-6 bg-white/5 backdrop-blur-sm border rounded-md">
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
    <div class="flex-1 px-10 py-7 overflow-y-auto">
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-yellow-400 mb-2">Active Directory</h1>
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

        <!-- Directory Grid -->
        <div class="space-y-6">
            <template x-for="(business, index) in paginatedBusinesses" :key="index">
                <div class="w-full bg-white/5 shadow-lg rounded-xl border border-white overflow-hidden transition-transform duration-300 hover:scale-[1.01] hover:shadow-xl">
                    <div class="flex items-center p-4">
                        <img :src="business.image" alt="Business Logo" class="w-20 h-20 rounded-full object-cover mr-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <h2 class="text-lg font-semibold text-white" x-text="business.name"></h2>
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414L9 13.414l4.707-4.707z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-sm text-white truncate" x-text="business.address"></p>
                        </div>
                    </div>
                    <div class="px-4 pb-4">
                        <p class="text-sm text-white line-clamp-2" x-text="business.description"></p>
                    </div>
                </div>
            </template>
        </div>

        <!-- Pagination Controls -->
        <div class="mt-8 flex justify-center space-x-2">
            <button 
                @click="currentPage--" 
                :disabled="currentPage === 1" 
                class="px-3 py-1 text-sm rounded-md bg-yellow-400 text-black hover:bg-yellow-300 disabled:opacity-50"
            >
                Previous
            </button>

            <template x-for="page in totalPages" :key="page">
                <button 
                    @click="currentPage = page"
                    class="px-3 py-1 text-sm rounded-md"
                    :class="currentPage === page ? 'bg-yellow-500 text-black' : 'bg-gray-700 text-white hover:bg-gray-600'"
                    x-text="page"
                ></button>
            </template>

            <button 
                @click="currentPage++" 
                :disabled="currentPage === totalPages" 
                class="px-3 py-1 text-sm rounded-md bg-yellow-400 text-black hover:bg-yellow-300 disabled:opacity-50"
            >
                Next
            </button>
        </div>
    </div>
</div>

<script>
function categorySidebar() {
    return {
        categories: [
            'Restaurants', 'Hair Salons', 'Gyms', 'Retail',
            'Healthcare', 'Automotive', 'Entertainment', 'Education',
        ],
        selected: [],
        currentPage: 1,
        itemsPerPage: 10,
        businesses: [
            { name: 'Ellis Development', address: '119 Atherton Gardens...', description: 'Coming soon!', image: '../img/ellis.png' },
            { name: 'Hair Studio X', address: '22 Main St, Townville', description: 'Trendy haircuts and styles.', image: '../img/ellis.png' },
            { name: 'Pulse Gym', address: '1 Fit Way, London', description: 'State-of-the-art fitness center.', image: '../img/ellis.png' },
            { name: 'Taco Fiesta', address: '7 Spice Ln, Leeds', description: 'Authentic Mexican street food.', image: '../img/ellis.png' },
            { name: 'Vision Optics', address: '44 Eye Rd, Bristol', description: 'Eyewear for everyone.', image: '../img/ellis.png' },
            { name: 'FixIt Garage', address: '101 Motor Ave, Sheffield', description: 'Reliable car service.', image: '../img/ellis.png' },
            { name: 'Happy Paws', address: '3 Pet Parade, Manchester', description: 'Grooming and boarding.', image: '../img/ellis.png' },
            { name: 'Learning Hub', address: '56 Knowledge Blvd', description: 'Tutoring for all ages.', image: '../img/ellis.png' },
            { name: 'Style Boutique', address: '9 Fashion Rd, Liverpool', description: 'Chic clothing and accessories.', image: '../img/ellis.png' },
            { name: 'Health First', address: '88 Wellness Dr', description: 'Your local health advisor.', image: '../img/ellis.png' },
            { name: 'Health First', address: '88 Wellness Dr', description: 'Your local health advisor.', image: '../img/ellis.png' },
            { name: 'Health First', address: '88 Wellness Dr', description: 'Your local health advisor.', image: '../img/ellis.png' },
            { name: 'Health First', address: '88 Wellness Dr', description: 'Your local health advisor.', image: '../img/ellis.png' },
            { name: 'Health First', address: '88 Wellness Dr', description: 'Your local health advisor.', image: '../img/ellis.png' },
            { name: 'Health First', address: '88 Wellness Dr', description: 'Your local health advisor.', image: '../img/ellis.png' },
            { name: 'Health First', address: '88 Wellness Dr', description: 'Your local health advisor.', image: '../img/ellis.png' },

        ],
        toggleCategory(cat) {
            if (this.selected.includes(cat)) {
                this.selected = this.selected.filter(c => c !== cat);
            } else {
                this.selected.push(cat);
            }
        },
        get totalPages() {
            return Math.ceil(this.businesses.length / this.itemsPerPage);
        },
        get paginatedBusinesses() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            return this.businesses.slice(start, start + this.itemsPerPage);
        }
    }
}
</script>
@endsection
