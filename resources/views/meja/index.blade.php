<x-layouts.app :title="'Meja'">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Meja</h1>
        <a href="{{ route('meja.create') }}"
            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Tambah
        </a>
    </div>

    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    {{-- Daftar Meja dalam bentuk card border --}}
    <div class="space-y-4">
        @forelse($mejas as $index => $meja)
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 flex items-center justify-between hover:shadow-md transition">
                <div class="flex flex-col">
                    <span class="text-sm text-gray-500">#{{ ($mejas->currentPage() - 1) * $mejas->perPage() + $loop->iteration }}</span>
                    <span class="text-lg font-semibold text-gray-800">{{ $meja->nama }}</span>
                    <span class="text-sm text-gray-600">Kode: {{ $meja->unique_code }}</span>
                    <span class="mt-1 inline-block px-2 py-0.5 text-xs font-semibold rounded-full
                        {{ $meja->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $meja->is_active ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('meja.qrcode', $meja->id) }}" target="_blank"
                       class="bg-blue-500 hover:bg-blue-600 text-white rounded-md px-3 py-1 text-sm">
                        QR Code
                    </a>
                    <a href="{{ route('meja.edit', $meja) }}"
                       class="bg-yellow-400 hover:bg-yellow-500 text-black rounded-md px-3 py-1 text-sm">
                        Edit
                    </a>
                    <button type="button"
                        onclick="showModal('deleteModal', '{{ route('meja.destroy', $meja) }}')"
                        class="bg-red-600 hover:bg-red-700 text-white rounded-md px-3 py-1 text-sm">
                        Delete
                    </button>
                </div>
            </div>
        @empty
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 text-center">
                <p class="text-gray-500">Tidak ada data meja.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $mejas->links() }}
    </div>

    <x-delete-modal modalId="deleteModal" modalTitle="Hapus Meja"
        message="Apakah Anda yakin ingin menghapus meja ini? Data yang sudah dihapus tidak dapat dikembalikan."
        formId="deleteForm">
    </x-delete-modal>
</x-layouts.app>
