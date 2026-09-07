<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-600 flex items-center justify-center font-bold text-lg">
                    🛡️
                </div>
                <div>
                    <h2 class="font-extrabold text-xl text-slate-900 leading-tight">Dashboard Administrator</h2>
                    <p class="text-xs text-slate-500 font-medium">Pusat kendali dan manajemen sistem CBT Online</p>
                </div>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-200/80 shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span> ROLE: ADMIN
            </span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Welcome Banner -->
        <div class="relative overflow-hidden bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white rounded-3xl p-6 sm:p-8 shadow-xl shadow-indigo-950/10">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 space-y-2 max-w-2xl">
                <span class="inline-block bg-indigo-500/30 text-indigo-200 text-xs font-bold px-3 py-1 rounded-lg backdrop-blur-md">
                    Sistem Aktif & Terkendali
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Selamat Datang, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-indigo-200/90 text-sm leading-relaxed">
                    Anda memiliki hak akses penuh sebagai Administrator. Kelola akun pengguna, bank soal, sesi ujian, dan import data siswa melalui panel ini.
                </p>
            </div>
        </div>

        <!-- System Quick Stats Grid -->
        @php
            $totalSoal = \App\Models\Soal::count();
            $totalMapel = \App\Models\Mapel::count();
            $totalUjian = \App\Models\Ujian::count();
            $totalSiswa = \App\Models\User::where('role', 'siswa')->count();
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-center gap-4 hover:border-indigo-200 transition">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xl shrink-0">
                    📚
                </div>
                <div>
                    <div class="text-2xl font-black text-slate-900">{{ $totalSoal }}</div>
                    <div class="text-xs font-bold text-slate-500">Total Soal</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-center gap-4 hover:border-indigo-200 transition">
                <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center font-bold text-xl shrink-0">
                    📖
                </div>
                <div>
                    <div class="text-2xl font-black text-slate-900">{{ $totalMapel }}</div>
                    <div class="text-xs font-bold text-slate-500">Mata Pelajaran</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-center gap-4 hover:border-indigo-200 transition">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xl shrink-0">
                    📝
                </div>
                <div>
                    <div class="text-2xl font-black text-slate-900">{{ $totalUjian }}</div>
                    <div class="text-xs font-bold text-slate-500">Sesi Ujian</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex items-center gap-4 hover:border-indigo-200 transition">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xl shrink-0">
                    👨‍🎓
                </div>
                <div>
                    <div class="text-2xl font-black text-slate-900">{{ $totalSiswa }}</div>
                    <div class="text-xs font-bold text-slate-500">Siswa Terdaftar</div>
                </div>
            </div>
        </div>

        <!-- Quick Shortcut Cards -->
        <div class="space-y-4">
            <h3 class="text-base font-extrabold text-slate-900">⚡ Modul Utama Administrator</h3>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.users.index') }}" class="bg-white rounded-2xl p-5 border border-slate-200/80 hover:border-rose-500/50 hover:shadow-md transition duration-200 group flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-lg mb-3 group-hover:bg-rose-600 group-hover:text-white transition duration-200">
                            👥
                        </div>
                        <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-rose-600 transition">Kelola Pengguna</h4>
                        <p class="text-xs text-slate-500 mt-1">Tambah & atur akun Admin, Guru, serta Siswa.</p>
                    </div>
                    <span class="text-xs font-extrabold text-rose-600 mt-4 block group-hover:translate-x-1 transition duration-200">Akses Pengguna &rarr;</span>
                </a>

                <a href="{{ route('guru.soal.index') }}" class="bg-white rounded-2xl p-5 border border-slate-200/80 hover:border-indigo-500/50 hover:shadow-md transition duration-200 group flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-lg mb-3 group-hover:bg-indigo-600 group-hover:text-white transition duration-200">
                            📚
                        </div>
                        <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-indigo-600 transition">Kelola Bank Soal</h4>
                        <p class="text-xs text-slate-500 mt-1">Buat & kelola pertanyaan pilihan ganda.</p>
                    </div>
                    <span class="text-xs font-extrabold text-indigo-600 mt-4 block group-hover:translate-x-1 transition duration-200">Buka Bank Soal &rarr;</span>
                </a>

                <a href="{{ route('guru.ujian.index') }}" class="bg-white rounded-2xl p-5 border border-slate-200/80 hover:border-violet-500/50 hover:shadow-md transition duration-200 group flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center font-bold text-lg mb-3 group-hover:bg-violet-600 group-hover:text-white transition duration-200">
                            📝
                        </div>
                        <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-violet-600 transition">Rangkai Ujian</h4>
                        <p class="text-xs text-slate-500 mt-1">Buat sesi ujian & susun soal terhubung.</p>
                    </div>
                    <span class="text-xs font-extrabold text-violet-600 mt-4 block group-hover:translate-x-1 transition duration-200">Atur Ujian &rarr;</span>
                </a>

                <a href="{{ route('laporan.index') }}" class="bg-white rounded-2xl p-5 border border-slate-200/80 hover:border-emerald-500/50 hover:shadow-md transition duration-200 group flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg mb-3 group-hover:bg-emerald-600 group-hover:text-white transition duration-200">
                            📊
                        </div>
                        <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-emerald-600 transition">Laporan & Export</h4>
                        <p class="text-xs text-slate-500 mt-1">Unduh laporan nilai ke Excel / PDF.</p>
                    </div>
                    <span class="text-xs font-extrabold text-emerald-600 mt-4 block group-hover:translate-x-1 transition duration-200">Lihat Laporan &rarr;</span>
                </a>
            </div>
        </div>

        <!-- Import Siswa Form Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-lg font-extrabold text-slate-900">Import Data Siswa Masal (Excel / CSV)</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Unggah berkas spreadsheet untuk mendaftarkan akun siswa secara kolektif</p>
                </div>
                <span class="px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-700 text-xs font-extrabold">.XLSX / .CSV</span>
            </div>

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-bold flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.import-siswa') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <div class="border-2 border-dashed border-slate-200/80 rounded-2xl p-6 text-center hover:border-indigo-400 bg-slate-50/50 transition">
                    <div class="max-w-md mx-auto space-y-3">
                        <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto text-xl">
                            📥
                        </div>
                        <div class="text-xs text-slate-600 font-medium">
                            Pilih file <span class="font-bold text-slate-900">.xlsx / .xls / .csv</span> dari komputer Anda
                        </div>
                        <input type="file" name="file_excel" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500 font-medium">
                        * Header kolom pertama Excel harus: <code class="bg-slate-100 px-1.5 py-0.5 rounded font-mono font-bold text-slate-800">nama</code>, <code class="bg-slate-100 px-1.5 py-0.5 rounded font-mono font-bold text-slate-800">email</code>, dan <code class="bg-slate-100 px-1.5 py-0.5 rounded font-mono font-bold text-slate-800">nis</code>.
                    </p>
                    <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-500 text-white font-extrabold px-6 py-2.5 rounded-xl text-xs transition duration-200 shadow-md shadow-indigo-600/20 flex items-center justify-center gap-2">
                        <span>Proses Import Siswa</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
