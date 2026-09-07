<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="font-extrabold text-xl text-slate-900 leading-tight">Lembar Ujian: {{ $ujian->judul }}</h2>
                <p class="text-xs text-slate-500 font-medium">Mata Pelajaran: {{ $ujian->mapel->nama_mapel ?? '-' }} | Durasi: {{ $ujian->durasi_menit }} Menit</p>
            </div>
            <span class="px-3.5 py-1.5 bg-amber-50 text-amber-800 border border-amber-200 text-xs font-extrabold rounded-xl shadow-2xs flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                <span>BERLANGSUNG</span>
            </span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <form action="{{ route('siswa.ujian.submit', $ujian->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengumpulkan lembar jawaban dan menyelesaikan ujian ini?');">
            @csrf

            <div class="space-y-6">
                @forelse($soals as $index => $soal)
                    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
                        <div class="flex items-start gap-3 border-b border-slate-100 pb-4">
                            <span class="bg-indigo-600 text-white font-black text-xs px-3 py-1 rounded-xl shadow-xs shrink-0">
                                Soal {{ $index + 1 }}
                            </span>
                            <div class="text-base font-bold text-slate-900 leading-relaxed pt-0.5">
                                {{ $soal->pertanyaan }}
                            </div>
                        </div>

                        <!-- Pilihan Jawaban A, B, C, D -->
                        <div class="space-y-3 pt-2">
                            <label class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-slate-200 hover:border-indigo-500/50 hover:bg-indigo-50/20 cursor-pointer transition duration-150">
                                <input type="radio" name="jawaban[{{ $soal->id }}]" value="a" class="w-4 h-4 text-indigo-600 border-slate-300 focus:ring-indigo-500">
                                <span class="text-xs font-extrabold text-indigo-700 bg-indigo-50 border border-indigo-100 px-2.5 py-1 rounded-lg">A</span>
                                <span class="text-sm text-slate-800 font-medium">{{ $soal->pilihan_a }}</span>
                            </label>

                            <label class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-slate-200 hover:border-indigo-500/50 hover:bg-indigo-50/20 cursor-pointer transition duration-150">
                                <input type="radio" name="jawaban[{{ $soal->id }}]" value="b" class="w-4 h-4 text-indigo-600 border-slate-300 focus:ring-indigo-500">
                                <span class="text-xs font-extrabold text-indigo-700 bg-indigo-50 border border-indigo-100 px-2.5 py-1 rounded-lg">B</span>
                                <span class="text-sm text-slate-800 font-medium">{{ $soal->pilihan_b }}</span>
                            </label>

                            <label class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-slate-200 hover:border-indigo-500/50 hover:bg-indigo-50/20 cursor-pointer transition duration-150">
                                <input type="radio" name="jawaban[{{ $soal->id }}]" value="c" class="w-4 h-4 text-indigo-600 border-slate-300 focus:ring-indigo-500">
                                <span class="text-xs font-extrabold text-indigo-700 bg-indigo-50 border border-indigo-100 px-2.5 py-1 rounded-lg">C</span>
                                <span class="text-sm text-slate-800 font-medium">{{ $soal->pilihan_c }}</span>
                            </label>

                            <label class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-slate-200 hover:border-indigo-500/50 hover:bg-indigo-50/20 cursor-pointer transition duration-150">
                                <input type="radio" name="jawaban[{{ $soal->id }}]" value="d" class="w-4 h-4 text-indigo-600 border-slate-300 focus:ring-indigo-500">
                                <span class="text-xs font-extrabold text-indigo-700 bg-indigo-50 border border-indigo-100 px-2.5 py-1 rounded-lg">D</span>
                                <span class="text-sm text-slate-800 font-medium">{{ $soal->pilihan_d }}</span>
                            </label>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-12 rounded-3xl border border-slate-200/80 text-center text-slate-400">
                        <p class="font-bold text-slate-600 text-sm">Belum ada pertanyaan pada sesi ujian ini.</p>
                    </div>
                @endforelse
            </div>

            @if($soals->count() > 0)
                <div class="mt-8 p-6 bg-white rounded-3xl border border-slate-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-slate-500 font-medium text-center sm:text-left">
                        *Periksa kembali semua jawaban Anda sebelum mengumpulkan lembar ujian ini.
                    </div>
                    <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-extrabold px-8 py-3 rounded-2xl text-xs transition duration-200 shadow-lg shadow-emerald-600/20 flex items-center justify-center gap-2">
                        <span>Selesai & Kirim Ujian</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </button>
                </div>
            @endif
        </form>

    </div>
</x-app-layout>
