<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="font-bold text-lg text-gray-900 leading-tight">Bank Soal Pilihan Ganda</h2>
                <p class="text-xs text-gray-500">Kelola soal dan tingkat kesulitan</p>
            </div>
            <a href="{{ route('guru.soal.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs px-4 py-2 rounded-lg transition shadow-sm">
                + Buat Soal Baru
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-600 uppercase tracking-wider">
                            <th class="py-3 px-4">Mata Pelajaran</th>
                            <th class="py-3 px-4">Pertanyaan</th>
                            <th class="py-3 px-4 text-center">Kesulitan</th>
                            <th class="py-3 px-4 text-center">Jawaban</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @forelse ($soals as $soal)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <span class="inline-block px-2.5 py-0.5 rounded text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                        {{ $soal->mapel->nama_mapel ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-gray-900 font-medium max-w-md">
                                    {{ $soal->pertanyaan }}
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap text-center">
                                    <span class="inline-block px-2 py-0.5 rounded text-xs font-semibold capitalize bg-gray-100 text-gray-700 border border-gray-200">
                                        {{ $soal->tingkat_kesulitan ?? 'mudah' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap text-center font-bold text-blue-600 uppercase">
                                    {{ $soal->jawaban_benar }}
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('guru.soal.edit', $soal->id) }}" class="text-xs font-semibold text-yellow-700 bg-yellow-50 hover:bg-yellow-100 px-2.5 py-1 rounded border border-yellow-200">
                                            Edit
                                        </a>
                                        <form action="{{ route('guru.soal.destroy', $soal->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus soal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded border border-red-200">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500 text-sm">
                                    Belum ada data soal yang dibuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($soals->hasPages())
                <div class="p-4 border-t border-gray-200">
                    {{ $soals->links() }}
                </div>
            @endif
        </div>

        @can('lihat-hasil-ujian')
            <div class="pt-2">
                <a href="{{ route('laporan.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">
                    Lihat Laporan Ujian &rarr;
                </a>
            </div>
        @endcan

    </div>
</x-app-layout>