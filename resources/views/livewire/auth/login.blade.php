<!-- Kartu Login dengan Gradasi Hijau -->
<div class="bg-gradient-to-br from-green-100 via-green-50 to-white rounded-xl shadow-lg p-8 w-full max-w-md flex flex-col gap-y-6">

    <!-- Header: Logo & Judul -->
    <div class="p-5 flex flex-col items-center border-b border-green-300">
        <img src="{{ asset('logo.jpeg') }}" alt="Logo Sagoro" class="w-16 h-auto mb-2">
        <div class="flex items-center space-x-2">
            <x-app-logo class="w-8 h-8 text-green-600" />
            <span class="text-lg font-bold text-green-700">Sagoro Foodcourt</span>
        </div>
    </div>

    <!-- Judul & Deskripsi -->
    <x-auth-header 
        :title="__('Selamat Datang Kembali!')" 
        :description="__('Masukkan detail akun Anda untuk melanjutkan.')" 
    />

    <!-- Status Session -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <!-- Form Login -->
    <form wire:submit="login" class="flex flex-col gap-y-6">
        <flux:input
            wire:model.blur="email"
            :label="__('Alamat Email')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="contoh@email.com"
        />

        <flux:input
            wire:model.blur="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="current-password"
            :placeholder="__('Masukkan password Anda')"
            viewable
        />

        <div class="flex items-center justify-between text-sm">
            <flux:checkbox wire:model="remember" :label="__('Ingat saya')" />
            <a href="{{ route('password.request') }}" wire:navigate
               class="font-medium text-green-600 hover:text-green-800 transition">
                {{ __('Lupa password?') }}
            </a>
        </div>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="login">
                    {{ __('Masuk') }}
                </span>
                <span wire:loading wire:target="login" class="flex items-center justify-center gap-2">
                    <x-spinner class="h-5 w-5" />
                    {{ __('Memproses...') }}
                </span>
            </flux:button>
        </div>
    </form>

    <!-- Garis Separator -->
    <div class="relative my-2">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-zinc-300"></div>
        </div>
    </div>

    <!-- Tautan Daftar -->
    <p class="text-center text-sm text-zinc-600">
        {{ __('Belum punya akun?') }}
        <a href="{{ route('register') }}" wire:navigate
           class="font-semibold text-green-600 hover:text-green-800 transition">
            {{ __('Daftar di sini') }}
        </a>
    </p>
</div>
