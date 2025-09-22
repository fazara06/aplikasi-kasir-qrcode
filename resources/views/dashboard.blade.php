<x-layouts.app :title="'Dashboard'" class="bg-gradient-to-br from-green-100 via-white to-cyan-100 min-h-screen">
    <div class="flex w-full flex-1 flex-col gap-4 p-4 md:p-6">
        <!-- Filters -->
        <div class="mb-4 flex flex-wrap items-center justify-between gap-4 bg-white p-4 rounded-xl border border-green-300 shadow-sm text-green-900 font-semibold">
            Selamat datang di Dashboard, {{ auth()->user()->name }}!
        </div>
        <div class="mb-4 flex flex-wrap items-center justify-between gap-4 bg-white p-4 rounded-xl border border-green-300 shadow-sm">
            <h2 class="text-lg font-semibold text-green-800">Filter Data</h2>
            <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-4">
                <select name="month" onchange="this.form.submit()" class="rounded-md border border-green-400 px-3 py-2 focus:ring-green-500 focus:border-green-500">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                    @endfor
                </select>

                <select name="year" onchange="this.form.submit()" class="rounded-md border border-green-400 px-3 py-2 focus:ring-green-500 focus:border-green-500">
                    @for ($y = date('Y') - 2; $y <= date('Y') + 2; $y++)
                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </form>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-green-50 p-6 rounded-xl border border-green-300 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-3">
                    <div class="p-3 bg-green-200 rounded-full">
                        <!-- Money Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.38 0-2.5 1.12-2.5 2.5S10.62 13 12 13s2.5-1.12 2.5-2.5S13.38 8 12 8z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16m-7 4h7m-7 0v1a3 3 0 01-6 0v-1m6 0H5" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-green-800">Pendapatan Bulan Ini</h3>
                        <p class="mt-1 text-2xl font-bold text-green-900">Rp{{ number_format($monthlyIncome ?? 0) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 p-6 rounded-xl border border-blue-300 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-3">
                    <div class="p-3 bg-blue-200 rounded-full">
                        <!-- Shopping Cart Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 7.5a1 1 0 001 1.5h11a1 1 0 001-1.5L17 13M7 13h10" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-blue-800">Jumlah Pesanan</h3>
                        <p class="mt-1 text-2xl font-bold text-blue-900">{{ $totalOrders ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-purple-50 p-6 rounded-xl border border-purple-300 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-center space-x-3">
                    <div class="p-3 bg-purple-200 rounded-full">
                        <!-- Table Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-purple-800">Meja Terbanyak Digunakan</h3>
                        <p class="mt-1 text-2xl font-bold text-purple-900">{{ optional($mostOccupiedTable)->nama ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Line Chart -->
        <div class="bg-white p-6 rounded-xl border border-neutral-200 shadow-sm mt-6 hover:shadow-lg transition-shadow duration-300">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Pendapatan Harian Bulan Ini</h3>
            <div class="w-full" style="height: 350px;">
                <canvas id="incomeLineChart"></canvas>
            </div>
        </div>

        <!-- Other Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <div class="bg-white p-6 rounded-xl border border-neutral-200 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Menu Terlaris</h3>
                <div class="w-full" style="height: 300px;">
                    <canvas id="bestSellingMenuChart"></canvas>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-neutral-200 shadow-sm hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Meja Paling Sering Digunakan</h3>
                <div class="w-full" style="height: 300px;">
                    <canvas id="mostOccupiedTablesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        function initiateCharts() {
            const incomeLineCtx = document.getElementById('incomeLineChart').getContext('2d');
            const bestSellingMenuCtx = document.getElementById('bestSellingMenuChart').getContext('2d');
            const mostOccupiedTablesCtx = document.getElementById('mostOccupiedTablesChart').getContext('2d');

            const dailyIncomeData = @json($dailyIncome ?? []);
            const selectedMonth = {{ $month }};
            const selectedYear = {{ $year }};
            const daysInMonth = new Date(selectedYear, selectedMonth, 0).getDate();

            const dayLabels = [];
            const incomeValues = [];

            for (let day = 1; day <= daysInMonth; day++) {
                dayLabels.push(day.toString());
                const dayData = dailyIncomeData.find(item => {
                    const itemDate = new Date(item.date);
                    return itemDate.getDate() === day;
                });
                incomeValues.push(dayData ? parseFloat(dayData.total) : 0);
            }

            new Chart(incomeLineCtx, {
                type: 'line',
                data: {
                    labels: dayLabels,
                    datasets: [{
                        label: 'Pendapatan Harian',
                        data: incomeValues,
                        borderColor: '#22c55e', // green-500
                        backgroundColor: 'rgba(34, 197, 94, 0.2)', 
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#22c55e',
                            borderWidth: 1,
                            callbacks: {
                                title: (ctx) => `Tanggal ${ctx[0].label}`,
                                label: (ctx) => `Pendapatan: Rp${parseInt(ctx.raw).toLocaleString('id-ID')}`,
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal',
                                font: { size: 12, weight: 'bold' }
                            },
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Pendapatan (Rp)',
                                font: { size: 12, weight: 'bold' }
                            },
                            ticks: {
                                callback: (value) => 'Rp' + value.toLocaleString('id-ID')
                            },
                            grid: { color: 'rgba(0, 0, 0, 0.1)' }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });

            new Chart(bestSellingMenuCtx, {
                type: 'bar',
                data: {
                    labels: @json(array_column($bestSellingMenus ?? [], 'name')),
                    datasets: [{
                        label: 'Terjual (Net)',
                        data: @json(array_column($bestSellingMenus ?? [], 'net_qty')),
                        backgroundColor: '#059669', // green-600
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#059669',
                            borderWidth: 1,
                            callbacks: {
                                label: (ctx) => `Terjual: ${ctx.raw} porsi`
                            }
                        }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: (value) => Number.isInteger(value) ? value : ''
                            },
                            grid: { color: 'rgba(0, 0, 0, 0.1)' }
                        }
                    }
                }
            });

            new Chart(mostOccupiedTablesCtx, {
                type: 'pie',
                data: {
                    labels: @json(array_column($tableUsage ?? [], 'meja')),
                    datasets: [{
                        label: 'Penggunaan Meja',
                        data: @json(array_column($tableUsage ?? [], 'count')),
                        backgroundColor: [
                            '#10B981',
                            '#F59E0B',
                            '#EF4444',
                            '#8B5CF6',
                            '#EC4899',
                            '#06B6D4',
                            '#84CC16',
                            '#F97316'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            callbacks: {
                                label: (ctx) => {
                                    const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((ctx.raw / total) * 100).toFixed(1);
                                    return `${ctx.label}: ${ctx.raw} kali (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        }

        if (document.readyState === 'complete') {
            initiateCharts();
        } else {
            document.addEventListener('DOMContentLoaded', initiateCharts);
        }
        document.addEventListener('turbo:load', initiateCharts);
    </script>
</x-layouts.app>
