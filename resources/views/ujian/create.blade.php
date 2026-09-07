<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-gray-900 leading-tight">Buat Sesi Ujian Baru</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-6">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-xs">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('guru.ujian.store') }}" class="space-y-6">
                @csrf

                <!-- Section 1: Informasi Ujian -->
                <div class="space-y-4">
                    <h3 class="text-sm font-bold text-gray-900 border-b border-gray-200 pb-2">1. Informasi Sesi Ujian</h3>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Judul Ujian</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Ujian Tengah Semester Web Dev" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Mata Pelajaran</label>
                        <select name="mapel_id" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach ($mapels as $mapel)
                                <option value="{{ $mapel->id }}" {{ old('mapel_id') == $mapel->id ? 'selected' : '' }}>
                                    {{ $mapel->nama_mapel }} ({{ $mapel->kode_mapel }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Durasi (Menit)</label>
                            <input type="number" name="durasi_menit" value="{{ old('durasi_menit', 60) }}" min="5" max="300" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Waktu Mulai</label>
                            <input type="datetime-local" name="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d\TH:i')) }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Waktu Selesai</label>
                            <input type="datetime-local" name="tanggal_selesai" value="{{ old('tanggal_selesai', date('Y-m-d\TH:i', strtotime('+7 days'))) }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Status Terbit</label>
                        <select name="status" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Aktif & Dilihat Siswa)</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Disimpan Sementara)</option>
                        </select>
                    </div>
                </div>

                <!-- Section 2: Langsung Pilih Soal-Soal -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-center justify-between border-b border-gray-200 pb-2">
                        <h3 class="text-sm font-bold text-gray-900">2. Pilih Soal-Soal untuk Ujian Ini</h3>
                        <span class="text-xs text-gray-500 font-medium">Centang soal yang ingin dimasukkan</span>
                    </div>

                    <div class="space-y-2 max-h-80 overflow-y-auto pr-1">
                        @forelse($soals as $soal)
                            <label class="flex items-start gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer transition">
                                <input type="checkbox" name="soal_ids[]" value="{{ $soal->id }}" {{ is_array(old('soal_ids')) && in_array($soal->id, old('soal_ids')) ? 'checked' : '' }} class="mt-0.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <div class="text-xs space-y-0.5">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">
                                            {{ $soal->mapel->nama_mapel ?? 'Umum' }}
                                        </span>
                                        <span class="capitalize text-gray-500 text-[11px]">Tingkat: {{ $soal->tingkat_kesulitan ?? 'mudah' }}</span>
                                    </div>
                                    <p class="text-gray-900 font-semibold text-sm pt-0.5">{{ $soal->pertanyaan }}</p>
                                </div>
                            </label>
                        @empty
                            <div class="py-6 text-center text-xs text-gray-500">
                                Belum ada soal tersedia di Bank Soal. Anda dapat menyimpan ujian ini terlebih dahulu dan membuat soal nanti.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Submit Controls -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg text-xs transition shadow-sm">
                        Simpan & Terbitkan Ujian
                    </button>
                    <a href="{{ route('guru.ujian.index') }}" class="text-xs text-gray-500 hover:underline">Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
