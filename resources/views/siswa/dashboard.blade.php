<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 flex items-center justify-center font-bold text-lg">
                    🎓
                </div>
                <div>
                    <h2 class="font-extrabold text-xl text-slate-900 leading-tight">Dashboard Siswa</h2>
                    <p class="text-xs text-slate-500 font-medium">Portal Akses Ujian Digital & Evaluasi Belajar</p>
                </div>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200/80 shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> ROLE: SISWA
            </span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-bold flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl text-xs font-bold flex items-center gap-2">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Welcome Banner Siswa -->
        <div class="relative overflow-hidden bg-gradient-to-r from-emerald-900 via-teal-950 to-slate-900 text-white rounded-3xl p-6 sm:p-8 shadow-xl shadow-emerald-950/10">
            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 space-y-2 max-w-2xl">
                <div class="flex items-center gap-2">
                    <span class="inline-block bg-emerald-500/30 text-emerald-200 text-xs font-bold px-3 py-1 rounded-lg backdrop-blur-md">
                        Peserta Ujian Digital
                    </span>
                    @if(auth()->user()->nis)
                        <span class="inline-block bg-white/10 text-white text-xs font-mono font-bold px-3 py-1 rounded-lg">
                            NIS: {{ auth()->user()->nis }}
                        </span>
                    @endif
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Selamat Datang, {{ auth()->user()->name }}! 🎓
                </h1>
                <p class="text-emerald-100/90 text-sm leading-relaxed">
                    Siapkan diri Anda dengan tenang sebelum mengerjakan ujian. Pilih sesi ujian yang telah dipublish oleh pengajar di bawah ini.
                </p>
            </div>
        </div>

        <!-- Daftar Ujian Aktif Grid -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-lg font-extrabold text-slate-900">Daftar Sesi Ujian Aktif</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Seluruh ujian berstatus Published yang siap Anda ikuti</p>
                </div>
                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-extrabold rounded-full border border-emerald-100">
                    REAL-TIME UPDATED
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($ujians as $ujian)
                    @php
                        $hasil = $hasilMap->get($ujian->id);
                        $statusText = 'Belum Dikerjakan';
                        $statusClass = 'bg-slate-100 text-slate-700 border-slate-200';

                        if ($hasil) {
                            if ($hasil->status === 'selesai') {
                                $statusText = 'Selesai (Nilai: ' . $hasil->nilai . ')';
                                $statusClass = 'bg-emerald-50 text-emerald-700 border-emerald-200 font-extrabold';
                            } elseif ($hasil->status === 'berlangsung') {
                                $statusText = 'Sedang Dikerjakan';
                                $statusClass = 'bg-amber-50 text-amber-700 border-amber-200 font-extrabold';
                            }
                        }
                    @endphp

                    <div class="bg-slate-50/50 border border-slate-200/80 hover:border-emerald-500/40 rounded-2xl p-6 space-y-4 flex flex-col justify-between transition duration-200 hover:shadow-md">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-extrabold text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-100">
                                    {{ $ujian->mapel->nama_mapel ?? 'Ujian' }}
                                </span>
                                <span class="inline-block px-2.5 py-1 rounded-lg text-xs border {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                            </div>

                            <h4 class="font-extrabold text-slate-900 text-lg leading-snug">{{ $ujian->judul }}</h4>

                            <div class="text-xs text-slate-500 space-y-1 font-medium pt-1">
                                <div class="flex items-center gap-1.5">⏱️ Durasi: <strong class="text-slate-800">{{ $ujian->durasi_menit }} Menit</strong></div>
                                <div class="flex items-center gap-1.5">📝 Jumlah Soal: <strong class="text-indigo-600 font-bold">{{ $ujian->soals->count() }} Pertanyaan Pilihan Ganda</strong></div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="pt-4 border-t border-slate-200/60 flex items-center justify-between">
                            <span class="text-[11px] text-slate-400 font-medium">Auto-Grading System</span>
                            @if($hasil && $hasil->status === 'selesai')
                                <a href="{{ route('siswa.ujian.hasil', $ujian->id) }}" class="bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold px-5 py-2.5 rounded-xl text-xs transition duration-200 shadow-md shadow-emerald-600/20">
                                    Lihat Hasil Ujian &rarr;
                                </a>
                            @else
                                <a href="{{ route('siswa.ujian.kerjakan', $ujian->id) }}" class="bg-indigo-600 hover:bg-indigo-500 text-white font-extrabold px-5 py-2.5 rounded-xl text-xs transition duration-200 shadow-md shadow-indigo-600/20 flex items-center gap-1.5">
                                    <span>{{ $hasil && $hasil->status === 'berlangsung' ? 'Lanjutkan Ujian' : 'Mulai Ujian' }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-slate-400">
                        <div class="max-w-sm mx-auto space-y-2">
                            <div class="text-4xl">📝</div>
                            <p class="font-extrabold text-slate-700 text-sm">Belum ada sesi ujian aktif.</p>
                            <p class="text-xs text-slate-400">Sesi ujian yang diterbitkan oleh pengajar akan otomatis tampil di halaman ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>