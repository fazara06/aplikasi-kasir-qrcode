<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-gray-50 dark:bg-zinc-900">
    @php
        $sidebarMenu = [
            ['name' => 'Dashboard', 'icon' => 'home', 'route' => 'dashboard', 'show' => ['role_kasir', 'role_admin', 'role_dapur']],
            ['name' => 'User', 'icon' => 'user', 'route' => 'users.index', 'show' => ['role_admin']],
            ['name' => 'Meja', 'icon' => 'table-cells', 'route' => 'meja.index', 'show' => ['role_admin']],
            ['name' => 'Daftar Tenant', 'icon' => 'building-storefront', 'route' => 'kategori.index', 'show' => ['role_admin']],
            ['name' => 'Menu', 'icon' => 'book-open', 'route' => 'menu.index', 'show' => ['role_admin']],
            ['name' => 'Order', 'icon' => 'receipt-percent', 'route' => 'order.index', 'show' => ['role_kasir', 'role_admin', 'role_dapur']],
            ['name' => 'Refund', 'icon' => 'arrow-uturn-left', 'route' => 'refunds.index', 'show' => ['role_kasir', 'role_admin']],
            ['name' => 'Laporan', 'icon' => 'chart-bar', 'route' => 'reports.index', 'show' => ['role_admin']],
        ];

        $userRole = auth()->user()->role;
        $sidebarMenu = array_filter($sidebarMenu, fn($menu) => in_array($userRole, $menu['show']));
    @endphp

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-700 text-white shadow-lg flex flex-col">
            <!-- Logo -->
<div class="p-5 flex flex-col items-center border-b border-indigo-600">
    <img src="{{ asset('logo.jpeg') }}" alt="Logo Sagoro" class="w-16 h-auto mb-2">
    <div class="flex items-center space-x-2">
        <x-app-logo class="w-8 h-8" />
        <span class="text-lg font-bold">Sagoro Foodcourt</span>
    </div>
</div>

            <!-- Navigation -->
            <nav class="flex-1 mt-4 space-y-1 px-2">
                @foreach($sidebarMenu as $menu)
                    <a href="{{ route($menu['route']) }}"
                       class="flex items-center px-4 py-2 rounded-lg transition-colors duration-150
                              {{ request()->routeIs($menu['route'])
                                ? 'bg-indigo-600 text-white font-semibold'
                                : 'text-indigo-100 hover:bg-indigo-600 hover:text-white' }}">

                        {{-- Heroicons --}}
                        @switch($menu['icon'])
                            @case('home')
                                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 12l2-2m0 0l7-7 7 7m-9 2v7h4v-7h5v9H4v-9h5z"/>
                                </svg>
                                @break

                            @case('user')
                                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5.121 17.804A9.985 9.985 0 0112 15c2.21 0 
                                             4.21.72 5.879 1.928M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                @break

                            @case('table-cells')
                                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                                @break

                            @case('building-storefront')
                                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 9.75V21h18V9.75M3 9.75L12 3l9 6.75"/>
                                </svg>
                                @break

                            @case('book-open')
                                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 20H5a2 2 0 01-2-2V6a2 2 0 012-2h7m0 16h7a2 2 0 002-2V6a2 2 0 
                                             00-2-2h-7m0 16V4"/>
                                </svg>
                                @break

                            @case('receipt-percent')
                                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 14l6-6m-6 0l6 6M7 7h.01M17 17h.01M3 3h18v18H3V3z"/>
                                </svg>
                                @break

                            @case('arrow-uturn-left')
                                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 15l-6-6 6-6"/>
                                </svg>
                                @break

                            @case('chart-bar')
                                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 3v18h18M9 17v-6m4 6V7m4 10V11"/>
                                </svg>
                                @break
                        @endswitch

                        {{ $menu['name'] }}
                    </a>
                @endforeach
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-indigo-600">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white transition">
                        <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 
                                     01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 
                                     013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 bg-gray-100 dark:bg-zinc-800 p-6">
            <!-- Header -->
            <header class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    {{ $title ?? 'Dashboard' }}
                </h1>

                <div class="flex items-center space-x-4">
                    <div class="bg-indigo-100 text-indigo-700 dark:bg-indigo-600 dark:text-white px-3 py-1 rounded-full text-sm">
                        {{ ucfirst(auth()->user()->role) }}
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                            {{ auth()->user()->initials() }}
                        </div>
                        <span class="font-medium text-gray-700 dark:text-gray-200">
                            {{ auth()->user()->name }}
                        </span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="bg-white dark:bg-zinc-700 shadow rounded-xl p-6">
                {{ $slot }}
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
