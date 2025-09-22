<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen flex bg-white dark:bg-zinc-800">
    <!-- Sidebar -->
    <aside class="w-64 min-h-screen bg-indigo-700 text-white flex flex-col">
        <!-- Logo -->
        <div class="p-5 flex items-center space-x-2 border-b border-indigo-600">
            <x-app-logo class="w-8 h-8" />
            <span class="text-lg font-bold">Sagoro</span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 mt-4 space-y-1 px-2">
            <a href="{{ route('dashboard') }}"
               class="flex items-center px-4 py-2 rounded-lg transition-colors duration-150
                      {{ request()->routeIs('dashboard')
                        ? 'bg-indigo-600 text-white font-semibold'
                        : 'text-indigo-100 hover:bg-indigo-600 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0v6H7v-6h6z"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('orders.index') }}"
               class="flex items-center px-4 py-2 rounded-lg transition-colors duration-150
                      {{ request()->routeIs('orders.index')
                        ? 'bg-indigo-600 text-white font-semibold'
                        : 'text-indigo-100 hover:bg-indigo-600 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
                Orders
            </a>
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-indigo-600 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 text-white transition">
                    <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 
                                 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 
                                 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <a href="{{ route('dashboard') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
                <x-app-logo />
            </a>
            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
            </flux:navbar>
            <flux:spacer />
            {{-- User Menu --}}
            <flux:dropdown position="top" align="end">
                <flux:profile class="cursor-pointer" :initials="auth()->user()->initials()" />
                <flux:menu>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <!-- Slot Content -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

    @fluxScripts
</body>
</html>
