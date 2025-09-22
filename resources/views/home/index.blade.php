<x-layouts.app.clean :title="'Home'">
<div class="min-h-screen bg-gradient-to-b from-neutral-50 via-white to-neutral-100 dark:from-neutral-900 dark:to-neutral-950">
    <!-- Header -->
    <header class="sticky top-0 z-20 shadow-md backdrop-blur-md bg-white/80 dark:bg-neutral-900/80">
        <!-- Banner -->
        <div class="p-5 flex flex-col items-center border-b border-green-300">
            <img src="{{ asset('logo.jpeg') }}" alt="Logo Sagoro" class="w-16 h-auto mb-2">
            <div class="flex items-center space-x-2">
                <x-app-logo class="w-8 h-8 text-green-600" />
                <p class="text-lg font-light italic mt-1" data-table-name="{{ $table?->name }}">
                    {{ $table?->name ? 'Table: ' . $table->name : 'Sagoro Foodcourt' }}
                </p>
            </div>
        </div>

        <!-- Category Navigation -->
        <div class="bg-white/90 backdrop-blur-md px-4 py-3 overflow-x-auto border-b border-neutral-200">
            <div class="flex space-x-3 whitespace-nowrap min-w-max">
                <!-- Semua menu -->
                <a href="{{ request()->url() }}?mejaId={{ $table->unique_code ?? '' }}"
                    class="px-5 py-2 rounded-full {{ request('category') == null && request('tipemenu') == null ? 'bg-teal-700 text-white' : 'bg-teal-50 text-teal-900' }} hover:bg-teal-600 hover:text-white transition-all duration-300 shadow-sm font-medium tracking-wide">
                    All Menu
                </a>

                <!-- Filter kategori -->
                @foreach ($menuCategories as $category)
                    <a href="{{ request()->url() }}?category={{ $category->id }}&mejaId={{ $table->unique_code ?? '' }}"
                        class="px-5 py-2 rounded-full {{ request('category') == $category->id ? 'bg-teal-700 text-white' : 'bg-teal-50 text-teal-900' }} hover:bg-teal-600 hover:text-white transition-all duration-300 shadow-sm font-medium tracking-wide">
                        {{ $category->nama }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Tipe Menu Navigation -->
        <div class="bg-white/90 backdrop-blur-md px-4 py-2 overflow-x-auto border-b border-neutral-200">
            <div class="flex space-x-3 whitespace-nowrap min-w-max">
                <a href="{{ request()->url() }}?tipemenu=makanan&mejaId={{ $table->unique_code ?? '' }}"
                    class="px-5 py-2 rounded-full {{ request('tipemenu') == 'makanan' ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-900' }} hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm font-medium tracking-wide">
                    Makanan
                </a>

                <a href="{{ request()->url() }}?tipemenu=minuman&mejaId={{ $table->unique_code ?? '' }}"
                    class="px-5 py-2 rounded-full {{ request('tipemenu') == 'minuman' ? 'bg-purple-600 text-white' : 'bg-purple-50 text-purple-900' }} hover:bg-purple-600 hover:text-white transition-all duration-300 shadow-sm font-medium tracking-wide">
                    Minuman
                </a>
            </div>
        </div>
    </header>

    <!-- Menu Items Grid -->
    <div class="container mx-auto px-4 py-8 pb-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($menus as $menu)
                <div
                    class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group menu-item">
                    <div class="relative h-52 overflow-hidden">
                        <img src="{{ asset('/storage/' . $menu->gambar) }}" alt="{{ $menu->nama }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            loading="lazy">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent opacity-60">
                        </div>
                        <div
                            class="absolute top-3 right-3 bg-teal-700/90 text-white px-3 py-1 rounded-full text-sm font-medium shadow-md">
                            {{ 'Rp ' . number_format($menu->harga, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="p-5">
                        <h3
                            class="font-medium text-xl text-teal-900 mb-1 group-hover:text-teal-700 transition-colors duration-300">
                            {{ $menu->nama }}
                        </h3>

                        <!-- Badge tipe menu -->
                        <span class="inline-block mb-3 px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $menu->tipemenu === 'makanan' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ ucfirst($menu->tipemenu) }}
                        </span>

                        <div class="min-h-[60px] mb-4">
                            <p class="text-neutral-600 text-sm">{{ $menu->deskripsi }}</p>
                        </div>
                        <button data-id="{{ $menu->id }}" data-name="{{ $menu->nama }}"
                            data-details="{{ $menu->deskripsi }}" data-price="{{ $menu->harga }}"
                            data-icon="fa-utensils" data-image="{{ asset('/storage/' . $menu->gambar) }}"
                            aria-label="Tambahkan {{ $menu->nama }} ke pesanan"
                            class="add-to-cart-btn add-to-order-btn w-full py-2.5 bg-teal-600 hover:bg-teal-800 text-white rounded-lg transition-colors duration-300 flex items-center justify-center shadow-sm group-hover:shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 0 014 0z" />
                            </svg>
                            Add to Order
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Cart Button - Fixed at bottom right -->
    <div class="fixed bottom-6 right-6 z-10">
        <a href="{{ route('cart.index', ['mejaId' => $table->unique_code ?? '']) }}"
            class="flex items-center justify-center w-16 h-16 bg-teal-700 text-white rounded-full hover:bg-teal-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 0 014 0z" />
            </svg>
            <div class="absolute -top-2 -right-2 bg-red-500 text-white w-6 h-6 rounded-full flex items-center justify-center text-sm font-bold shadow-sm"
                id="cart-count">{{ session('cart') ? count(session('cart')) : 0 }}</div>
        </a>
    </div>

    <!-- Include the modal component -->
    <x-order-modal />
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function() {
                const modal = document.getElementById('addToCartModal');

                document.getElementById('modalMenuId').value = this.dataset.id;
                document.getElementById('modalMenuName').textContent = this.dataset.name;
                document.getElementById('modalMenuDetails').textContent = this.dataset.details;

                document.getElementById('modalMenuNameInput').value = this.dataset.name;
                document.getElementById('modalMenuPrice').value = this.dataset.price;
                document.getElementById('modalMenuImageInput').value = this.dataset.image;

                const imgElement = document.getElementById('modalMenuImage');
                const imgContainer = document.getElementById('modalMenuImage').parentElement;
                const iconElement = imgContainer.querySelector('i');

                if (iconElement) iconElement.remove();

                if (this.dataset.image && this.dataset.image !== '-') {
                    imgElement.src = this.dataset.image;
                    imgElement.alt = this.dataset.name;
                    imgElement.classList.remove('hidden');
                } else {
                    imgElement.classList.add('hidden');
                    imgContainer.insertAdjacentHTML('beforeend',
                        `<i class="fas ${this.dataset.icon} text-2xl text-gray-400"></i>`);
                }

                document.getElementById('quantity').value = 1;
                document.getElementById('notes').value = '';

                modal.classList.remove('hidden');
            });
        });
    });
</script>
</x-layouts.app.clean>
