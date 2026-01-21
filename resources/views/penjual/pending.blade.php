@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 dark:bg-gray-900 px-4 pt-24">
        <div class="max-w-md w-full text-center space-y-6 animate-slide-up">

            {{-- Ilustrasi --}}
            <div class="relative w-40 h-40 mx-auto">
                <div class="absolute inset-0 bg-orange-100 dark:bg-orange-900/30 rounded-full animate-pulse"></div>
                <div class="relative flex items-center justify-center w-full h-full text-primary-orange">
                    <span class="material-symbols-outlined text-7xl">hourglass_top</span>
                </div>
            </div>

            {{-- Pesan --}}
            <div class="space-y-3">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                    Sedang Ditinjau
                </h1>
                <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed">
                    Terima kasih sudah mendaftar! Data usaha <span
                        class="font-bold text-gray-800 dark:text-gray-200">"{{ auth()->user()->umkm->nama_usaha }}"</span>
                    sedang diperiksa oleh Admin.
                </p>
                <div
                    class="bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 px-4 py-3 rounded-xl text-sm font-medium border border-blue-100 dark:border-blue-800 mt-4">
                    <span class="block mb-1 font-bold">Estimasi Waktu:</span>
                    Biasanya proses ini memakan waktu 1x24 Jam. Silakan cek berkala.
                </div>
            </div>

            {{-- Opsional: Tombol Logout jika mereka ingin ganti akun --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full py-3 rounded-xl bg-white border-2 border-gray-200 text-gray-700 font-bold hover:border-primary-orange hover:text-primary-orange transition-all">
                    Keluar Akun
                </button>
            </form>
        </div>

    </div>
    </div>
@endsection