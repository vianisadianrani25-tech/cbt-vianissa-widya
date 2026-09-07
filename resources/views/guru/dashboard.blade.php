<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="font-bold text-lg text-gray-900 leading-tight">Dashboard Guru</h2>
                <p class="text-xs text-gray-500">Kelola soal, ujian, dan penilaian siswa</p>
            </div>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">
                ROLE: GURU
            </span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        
        <!-- Welcome Banner -->
        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
            <h1 class="text-xl font-bold text-gray-900">
                Selamat Datang, {{ auth()->user()->name }}! 👨‍🏫
            </h1>
            <p class="text-xs text-gray-600 mt-1">
                Anda login sebagai guru pengajar. Pilih modul di bawah ini untuk mengelola ujian digital.
            </p>
        </div>

        <!-- Quick Shortcut Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('guru.soal.index') }}" class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:border-blue-500 transition block group">
                <h3 class="font-bold text-gray-900 text-base group-hover:text-blue-600">Bank Soal Saya &rarr;</h3>
                <p class="text-xs text-gray-500 mt-1">Buat dan kelola bank soal pilihan ganda.</p>
            </a>

            <a href="{{ route('guru.ujian.index') }}" class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:border-blue-500 transition block group">
                <h3 class="font-bold text-gray-900 text-base group-hover:text-blue-600">Rangkai Ujian &rarr;</h3>
                <p class="text-xs text-gray-500 mt-1">Atur paket soal untuk dimasukkan ke sesi ujian.</p>
            </a>

            <a href="{{ route('laporan.index') }}" class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:border-blue-500 transition block group">
                <h3 class="font-bold text-gray-900 text-base group-hover:text-blue-600">Hasil & Laporan &rarr;</h3>
                <p class="text-xs text-gray-500 mt-1">Lihat dan unduh rekapitulasi nilai ke Excel/PDF.</p>
            </a>
        </div>

    </div>
</x-app-layout>
