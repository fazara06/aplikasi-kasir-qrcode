<x-layouts.app :title="'Daftar Pesanan'">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-3">
        <h1 class="text-2xl font-bold text-gray-800">📋 Daftar Pesanan</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('order.index') }}" class="flex items-center gap-2">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Cari kode order..." 
                    value="{{ request('search') }}"
                    class="block w-64 pl-4 pr-10 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                >
                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 
                               3.476l4.817 4.817a1 1 0 01-1.414 
                               1.414l-4.816-4.816A6 6 0 012 8z" 
                            clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>

            <button type="submit" 
                class="px-4 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                Cari
            </button>

            @if (request('search'))
                <a href="{{ route('order.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition shadow">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Cashier Session -->
    @if($needValidateSession)
        <div class="mb-6 p-4 rounded-xl shadow-sm border 
            {{ $cashierSession ? 'bg-blue-50 border-blue-200' : 'bg-yellow-50 border-yellow-200' }}">
            @if ($cashierSession)
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-blue-800">Sesi Kasir Aktif ✅</h3>
                        <p class="text-sm text-gray-600">Dibuka: {{ $cashierSession->start_time->format('d/m/Y H:i') }}</p>
                        <p class="text-sm text-gray-600">Saldo Awal: <span class="font-medium">Rp {{ number_format($cashierSession->starting_cash, 0, ',', '.') }}</span></p>
                        <p class="text-sm text-gray-600">Kasir: {{ $cashierSession->user->name }} ({{ $cashierSession->user->email }})</p>
                    </div>
                    <a href="{{ route('admin.sessions.close', $cashierSession->id) }}" 
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm shadow transition">
                        Tutup Sesi
                    </a>
                </div>
            @else
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-yellow-800">⚠️ Kasir Belum Dibuka</h3>
                        <p class="text-sm text-gray-600">Silakan buka sesi kasir untuk memproses pembayaran tunai.</p>
                    </div>
                    <a href="{{ route('admin.sessions.open') }}" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm shadow transition">
                        Buka Sesi Kasir
                    </a>
                </div>
            @endif
        </div>
    @endif

    <!-- Revenue Summary -->
    @if(auth()->user()->role != "role_dapur")
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <x-summary-card title="Total Pendapatan Hari Ini" value="Rp {{ number_format($summary['total_pendapatan'], 0, ',', '.') }}" highlight="green">
                <span class="{{ $summary['total_refund'] > 0 ? 'text-red-500' : 'text-gray-500' }}">
                    Refund: Rp {{ number_format($summary['total_refund'], 0, ',', '.') }}
                </span>
            </x-summary-card>
            <x-summary-card title="Pendapatan Cash" value="Rp {{ number_format($summary['pendapatan_cash'], 0, ',', '.') }}" highlight="green"/>
            <x-summary-card title="Pendapatan Digital" value="Rp {{ number_format($summary['pendapatan_digital'], 0, ',', '.') }}" highlight="green"/>
            <x-summary-card title="Total Kotor" value="Rp {{ number_format($summary['gross_pendapatan'], 0, ',', '.') }}" highlight="blue"/>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="bg-white shadow rounded-xl mb-6">
        <form method="GET" action="{{ route('order.index') }}" class="grid md:grid-cols-4 gap-4 p-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Kode Order</label>
                <input type="text" name="kode" value="{{ request('kode') }}"
                       placeholder="Cari ..." 
                       class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm 
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Pilih Meja</label>
                <select name="meja"
                        class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm 
                               focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Meja</option>
                    @foreach ($mejas as $meja)
                        <option value="{{ $meja->id }}" {{ request('meja') == $meja->id ? 'selected' : '' }}>
                            {{ $meja->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Order</label>
                <input type="date" name="date" value="{{ $date }}"
                       class="w-full mt-1 px-3 py-2 border rounded-lg shadow-sm 
                              focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    Filter
                </button>
                <a href="{{ route('order.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 transition">
                    Reset
                </a>
            </div>
        </form>

        <!-- Pilih Tampilan -->
        <div class="border-t px-6 py-4 flex items-center gap-4">
            <label class="text-sm font-medium text-gray-700">Tampilan:</label>
            <form method="GET" action="{{ route('order.index') }}">
                <input type="hidden" name="kode" value="{{ request('kode') }}">
                <input type="hidden" name="meja" value="{{ request('meja') }}">
                <input type="hidden" name="date" value="{{ request('date') }}">
                <select name="view" onchange="this.form.submit()"
                        class="px-3 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500">
                    <option value="card" {{ request('view', 'card') == 'card' ? 'selected' : '' }}>Card</option>
                    <option value="table" {{ request('view') == 'table' ? 'selected' : '' }}>Table</option>
                </select>
            </form>
        </div>
    </div>

    @php
        $viewMode = request('view', 'card');
    @endphp

    @if($viewMode === 'table')
        <!-- Table View -->
<div class="bg-white shadow-xl rounded-2xl p-6 overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border-collapse">
            <thead>
                <tr class="bg-gradient-to-r from-blue-50 to-indigo-50 text-gray-700 uppercase text-xs tracking-wider">
                    <th class="px-4 py-3 border-b">No Order</th>
                    <th class="px-4 py-3 border-b">Meja</th>
                    <th class="px-4 py-3 border-b">Pesanan</th>
                    <th class="px-4 py-3 border-b">Tipe Menu</th>
                    <th class="px-4 py-3 border-b">Timer</th>
                    <th class="px-4 py-3 border-b text-center">Selesai</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                    @forelse($order->orderDetails as $detail)
                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                            <td class="px-4 py-3 font-semibold text-gray-800">#{{ $order->transaction_code }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $order->meja->nama ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-700">
                                <span class="font-medium">{{ $detail->menu->nama }}</span>
                                <span class="ml-1 text-gray-500">(x{{ $detail->qty }})</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $detail->menu->tipemenu === 'makanan' 
                                        ? 'bg-blue-100 text-blue-800' 
                                        : 'bg-purple-100 text-purple-800' }}">
                                    {{ ucfirst($detail->menu->tipemenu) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="timer text-sm font-bold text-red-600 tracking-wider"
                                      data-start="{{ $detail->created_at->format('c') }}"
                                      data-type="{{ $detail->menu->tipemenu }}"
                                      data-done="{{ $detail->is_done ? 1 : 0 }}">
                                    00:00
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <input type="checkbox" 
                                       class="toggle-done w-5 h-5 text-green-600 rounded border-gray-300 focus:ring focus:ring-green-300 cursor-pointer transition"
                                       data-id="{{ $detail->id }}"
                                       {{ $detail->is_done ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                Tidak ada item pesanan
                            </td>
                        </tr>
                    @endforelse
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            Tidak ada pesanan tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $orders->appends(request()->query())->links() }}
    </div>
</div>
    @else
        <!-- Card View -->
        <div class="grid gap-4">
            @forelse($orders as $order)
                <div class="bg-white shadow rounded-xl p-5 border hover:shadow-md transition">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <h2 class="font-semibold text-gray-800">Order #{{ $order->transaction_code }}</h2>
                            <p class="text-sm text-gray-500">{{ $order->tanggal->format('d/m/Y H:i') }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full {{ $statusConfig[$order->status]['class'] }}">
                            {{ $statusConfig[$order->status]['label'] }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600">Meja: {{ $order->meja->nama ?? '-' }}</p>
                    <div class="mt-3">
                        <a href="{{ route('orders.detail', $order) }}"
                           class="px-3 py-1 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 text-sm transition">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-white p-6 rounded-xl border text-center text-gray-500">
                    Tidak ada pesanan tersedia
                </div>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    @endif
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const baseUrl = "{{ url('order-details') }}"; // ✅ URL fix

        function pad(num){ return num.toString().padStart(2,'0'); }

        function updateTimers(){
            document.querySelectorAll('.timer').forEach(el=>{
                if(el.dataset.done === "1"){
                    el.classList.remove('text-red-600');
                    el.classList.add('text-gray-500');
                    el.textContent = "Selesai";
                    return;
                }

                const cb = el.closest('tr').querySelector('.toggle-done');
                if(cb && cb.checked){
                    el.dataset.done = "1";
                    el.classList.remove('text-red-600');
                    el.classList.add('text-gray-500');
                    el.textContent = "Selesai";
                    return;
                }

                const start = new Date(el.dataset.start);
                const type = el.dataset.type;
                const limitSeconds = type === 'makanan' ? 600 : 300;
                const endTime = new Date(start.getTime() + limitSeconds*1000);
                const now = new Date();
                let remaining = Math.floor((endTime - now)/1000);

                if(remaining <= 0){
                    el.dataset.done = "1";
                    el.classList.remove('text-red-600');
                    el.classList.add('text-gray-500');
                    el.textContent = "Selesai";
                    if(cb) cb.checked = true;

                    if(cb){
                        const id = cb.dataset.id;
                        fetch(`${baseUrl}/${id}/toggle-done`, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({is_done:1})
                        })
                        .then(res=>res.json())
                        .then(data=>console.log(data))
                        .catch(()=>console.log('Gagal update DB otomatis'));
                    }
                    return;
                }

                const minutes = Math.floor(remaining/60);
                const seconds = remaining % 60;
                el.textContent = pad(minutes) + ':' + pad(seconds);
            });
        }

        setInterval(updateTimers, 1000);
        updateTimers();

        document.querySelectorAll('.toggle-done').forEach(cb=>{
            cb.addEventListener('change', function(){
                const id = this.dataset.id;
                const timer = this.closest('tr').querySelector('.timer');
                const isDone = this.checked ? 1 : 0;

                timer.dataset.done = isDone ? "1" : "0";

                fetch(`${baseUrl}/${id}/toggle-done`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({is_done:isDone})
                })
                .then(res=>res.json())
                .then(data=>{
                    console.log(data);
                    if(data.success){
                        if(isDone){
                            timer.classList.remove('text-red-600');
                            timer.classList.add('text-gray-500');
                            timer.textContent = "Selesai";
                        } else {
                            timer.classList.remove('text-gray-500');
                            timer.classList.add('text-red-600');
                            updateTimers();
                        }
                    } else {
                        this.checked = !this.checked;
                    }
                })
                .catch(()=>{
                    this.checked = !this.checked;
                });
            });
        });
    });
    </script>
</x-layouts.app>
