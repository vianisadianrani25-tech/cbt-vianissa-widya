<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CBT Online Exam System — Portal Ujian Digital Modern</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col selection:bg-indigo-500 selection:text-white antialiased relative overflow-x-hidden">

    <!-- Background Ambient Glows -->
    <div class="fixed top-0 left-1/4 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-[140px] pointer-events-none -z-10"></div>
    <div class="fixed bottom-0 right-1/4 w-[450px] h-[450px] bg-violet-600/15 rounded-full blur-[140px] pointer-events-none -z-10"></div>

    <!-- Navigation Header -->
    <header class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between z-10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-500 via-indigo-600 to-violet-600 text-white font-extrabold text-xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
                C
            </div>
            <div>
                <span class="font-extrabold text-xl tracking-tight text-white">CBT<span class="text-indigo-400">App</span></span>
                <span class="block text-[10px] text-slate-400 font-semibold tracking-wider uppercase">Portal Ujian Digital</span>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @if (Route::has('login'))
                @auth
                    @php
                        $dashboardUrl = match(Auth::user()->role) {
                            'admin' => route('admin.dashboard'),
                            'guru' => route('guru.dashboard'),
                            'siswa' => route('siswa.dashboard'),
                            default => url('/dashboard')
                        };
                    @endphp
                    <a href="{{ $dashboardUrl }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition duration-200 shadow-lg shadow-indigo-600/30">
                        <span>Buka Dashboard</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-white font-semibold text-sm px-4 py-2 rounded-xl transition hover:bg-slate-800/80">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition duration-200 shadow-lg shadow-indigo-600/30">
                            Daftar Siswa
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex flex-col justify-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20 z-10 w-full">
        <div class="text-center max-w-3xl mx-auto space-y-6">
            
            <div class="inline-flex items-center gap-2 bg-slate-900/90 border border-slate-800 text-indigo-400 text-xs font-semibold px-4 py-1.5 rounded-full shadow-inner">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>Sistem CBT Engine Generasi Baru</span>
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight text-white">
                Platform Ujian Online <br>
                <span class="bg-gradient-to-r from-indigo-400 via-violet-400 to-purple-400 bg-clip-text text-transparent">Cepat, Aman & Terstruktur</span>
            </h1>

            <p class="text-base sm:text-lg text-slate-400 font-normal leading-relaxed max-w-2xl mx-auto">
                Kelola Bank Soal, Sesi Ujian, Evaluasi Otomatis, dan Laporan Hasil Ujian Digital siswa secara mudah dan komprehensif dalam satu portal terintegrasi.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold text-base px-8 py-3.5 rounded-xl transition-all duration-200 shadow-xl shadow-indigo-600/25 hover:scale-[1.02]">
                    <span>Masuk ke System Portal</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <!-- Role Features Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16 lg:mt-24">
            
            <!-- Card Admin -->
            <div class="bg-slate-900/60 border border-slate-800/80 rounded-2xl p-6 hover:border-indigo-500/50 transition duration-300 backdrop-blur-xl group hover:-translate-y-1">
                <div class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 flex items-center justify-center font-bold mb-5 group-hover:bg-rose-500 group-hover:text-white transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">Portal Admin</h3>
                <p class="text-sm text-slate-400 leading-relaxed mb-4">
                    Kelola pengguna, import data siswa via Excel, manajemen permission Spatie, dan kontrol penuh hak akses sistem.
                </p>
                <span class="inline-flex items-center text-xs font-semibold text-rose-400 group-hover:translate-x-1 transition duration-200">
                    Akses Khusus Administrator &rarr;
                </span>
            </div>

            <!-- Card Guru -->
            <div class="bg-slate-900/60 border border-slate-800/80 rounded-2xl p-6 hover:border-indigo-500/50 transition duration-300 backdrop-blur-xl group hover:-translate-y-1">
                <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold mb-5 group-hover:bg-indigo-600 group-hover:text-white transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">Portal Guru</h3>
                <p class="text-sm text-slate-400 leading-relaxed mb-4">
                    Buat bank soal pilihan ganda, atur tingkat kesulitan, rangkai sesi ujian, serta cetak laporan Excel & PDF.
                </p>
                <span class="inline-flex items-center text-xs font-semibold text-indigo-400 group-hover:translate-x-1 transition duration-200">
                    Akses Bank Soal & Ujian &rarr;
                </span>
            </div>

            <!-- Card Siswa -->
            <div class="bg-slate-900/60 border border-slate-800/80 rounded-2xl p-6 hover:border-indigo-500/50 transition duration-300 backdrop-blur-xl group hover:-translate-y-1">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold mb-5 group-hover:bg-emerald-500 group-hover:text-white transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">Portal Siswa</h3>
                <p class="text-sm text-slate-400 leading-relaxed mb-4">
                    Kerjakan ujian secara online dengan timer interaktif, melihat hasil ujian, dan evaluasi hasil belajar.
                </p>
                <span class="inline-flex items-center text-xs font-semibold text-emerald-400 group-hover:translate-x-1 transition duration-200">
                    Akses Lembar Ujian &rarr;
                </span>
            </div>

        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 border-t border-slate-900 text-center text-xs text-slate-500 z-10">
        <p>&copy; {{ date('Y') }} CBT Online Exam System — All rights reserved.</p>
    </footer>

</body>
</html>
