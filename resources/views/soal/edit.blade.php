<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-gray-900 leading-tight">Edit Soal</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4 text-xs">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('guru.soal.update', $soal->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Mata Pelajaran</label>
                    <select name="mapel_id" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                        @foreach ($mapels as $mapel)
                            <option value="{{ $mapel->id }}" {{ old('mapel_id', $soal->mapel_id) == $mapel->id ? 'selected' : '' }}>
                                {{ $mapel->nama_mapel }} ({{ $mapel->kode_mapel }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Pertanyaan Soal</label>
                    <textarea name="pertanyaan" rows="4" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Pilihan A</label>
                        <input type="text" name="pilihan_a" value="{{ old('pilihan_a', $soal->pilihan_a) }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Pilihan B</label>
                        <input type="text" name="pilihan_b" value="{{ old('pilihan_b', $soal->pilihan_b) }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Pilihan C</label>
                        <input type="text" name="pilihan_c" value="{{ old('pilihan_c', $soal->pilihan_c) }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Pilihan D</label>
                        <input type="text" name="pilihan_d" value="{{ old('pilihan_d', $soal->pilihan_d) }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Jawaban Benar</label>
                        <select name="jawaban_benar" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="a" {{ old('jawaban_benar', $soal->jawaban_benar) == 'a' ? 'selected' : '' }}>A</option>
                            <option value="b" {{ old('jawaban_benar', $soal->jawaban_benar) == 'b' ? 'selected' : '' }}>B</option>
                            <option value="c" {{ old('jawaban_benar', $soal->jawaban_benar) == 'c' ? 'selected' : '' }}>C</option>
                            <option value="d" {{ old('jawaban_benar', $soal->jawaban_benar) == 'd' ? 'selected' : '' }}>D</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Tingkat Kesulitan</label>
                        <select name="tingkat_kesulitan" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="mudah" {{ old('tingkat_kesulitan', $soal->tingkat_kesulitan) == 'mudah' ? 'selected' : '' }}>Mudah</option>
                            <option value="sedang" {{ old('tingkat_kesulitan', $soal->tingkat_kesulitan) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="sulit" {{ old('tingkat_kesulitan', $soal->tingkat_kesulitan) == 'sulit' ? 'selected' : '' }}>Sulit</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg text-xs transition">
                        Update Soal
                    </button>
                    <a href="{{ route('guru.soal.index') }}" class="text-xs text-gray-500 hover:underline">Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
