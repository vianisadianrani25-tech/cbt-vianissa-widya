<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-slate-900 leading-tight">Hasil & Evaluasi Ujian</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-bold flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm text-center space-y-6">
            <div>
                <span class="inline-block px-3.5 py-1 bg-indigo-50 text-indigo-700 text-xs font-extrabold rounded-full mb-3 border border-indigo-100">
                    {{ $ujian->mapel->nama_mapel ?? 'Ujian Digital' }}
                </span>
                <h3 class="text-2xl font-black text-slate-900">{{ $ujian->judul }}</h3>
                <p class="text-xs text-slate-500 font-medium mt-1">Status: Evaluasi Otomatis Selesai</p>
            </div>

            <!-- Score Display Card -->
            <div class="bg-gradient-to-b from-slate-50 to-indigo-50/30 border border-slate-200/80 rounded-3xl p-8 max-w-sm mx-auto space-y-3 shadow-inner">
                <div class="text-xs font-extrabold text-slate-500 uppercase tracking-widest">Nilai Akhir Anda</div>
                <div class="text-6xl font-black tracking-tight {{ $hasil->nilai >= 70 ? 'text-emerald-600' : 'text-amber-600' }}">
                    {{ $hasil->nilai }}
                </div>
                <div class="text-xs font-bold text-slate-700 pt-2">
                    {{ $hasil->nilai >= 70 ? '🎉 Selamat! Hasil Anda Memenuhi KKM' : '📚 Perlu Peningkatan Hasil Belajar' }}
                </div>
            </div>

            <!-- Breakdown Grid -->
            <div class="grid grid-cols-2 gap-4 max-w-sm mx-auto text-xs">
                <div class="bg-emerald-50/60 border border-emerald-200/80 p-4 rounded-2xl">
                    <span class="text-slate-500 font-medium block">Jawaban Benar</span>
                    <span class="text-lg font-black text-emerald-700 mt-1 block">{{ $hasil->jumlah_benar }} Soal</span>
                </div>
                <div class="bg-rose-50/60 border border-rose-200/80 p-4 rounded-2xl">
                    <span class="text-slate-500 font-medium block">Jawaban Salah</span>
                    <span class="text-lg font-black text-rose-700 mt-1 block">{{ $hasil->jumlah_salah }} Soal</span>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <a href="{{ route('siswa.dashboard') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white font-extrabold px-8 py-3 rounded-2xl text-xs transition duration-200 shadow-md shadow-indigo-600/20 inline-block">
                    Kembali ke Dashboard Siswa
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
