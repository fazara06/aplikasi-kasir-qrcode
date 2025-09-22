<x-layouts.app :title="'Menu'">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Menu</h1>
        <a href="{{ route('menu.create') }}" 
           class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Tambah
        </a>
    </div>

    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    @if($menus->count() > 0)
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($menus as $menu)
                <div class="border rounded-lg shadow-sm overflow-hidden bg-white hover:shadow-md transition">
                    <!-- Gambar menu -->
                    <div class="h-40 w-full bg-gray-100 flex items-center justify-center overflow-hidden">
                        @if($menu->gambar)
                            <img src="{{ asset('storage/' . $menu->gambar) }}" 
                                 alt="{{ $menu->nama }}" 
                                 class="object-cover w-full h-full">
                        @else
                            <span class="text-gray-400">Tidak ada gambar</span>
                        @endif
                    </div>

                    <!-- Detail menu -->
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-900 truncate">{{ $menu->nama }}</h2>
                        <p class="text-sm text-gray-600">Tenant: {{ $menu->kategori->nama }}</p>
                        
                        <!-- Tipe menu -->
                        <span class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $menu->tipemenu === 'makanan' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ ucfirst($menu->tipemenu) }}
                        </span>

                        <p class="text-base font-bold text-green-700 mt-2">
                            Rp {{ number_format($menu->harga, 0, ',', '.') }}
                        </p>

                        <!-- Status -->
                        <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $menu->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $menu->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>

                        <!-- Aksi -->
                        <div class="flex space-x-2 mt-4">
                            <a href="{{ route('menu.edit', $menu) }}" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-black rounded-md px-3 py-1 text-sm font-medium">
                                Edit
                            </a>
                            <button
                                class="bg-red-600 hover:bg-red-700 text-white rounded-md px-3 py-1 text-sm font-medium"
                                type="button"
                                onclick="showModal('deleteModal', '{{ route('menu.destroy', $menu) }}')"
                            >
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $menus->links() }}
        </div>
    @else
        <div class="text-center py-10 text-gray-500">
            Tidak ada menu tersedia
        </div>
    @endif

    <x-delete-modal
        modalId="deleteModal"
        modalTitle="Hapus Menu"
        message="Apakah Anda yakin ingin menghapus menu ini? Data yang sudah dihapus tidak dapat dikembalikan."
        formId="deleteForm"
    >
    </x-delete-modal>
</x-layouts.app>
