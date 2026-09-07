<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="font-bold text-lg text-gray-900 leading-tight">Laporan Hasil Ujian</h2>
                <p class="text-xs text-gray-500">Unduh laporan nilai hasil ujian peserta</p>
            </div>
            <span class="px-2.5 py-0.5 bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold rounded">
                EXCEL & PDF
            </span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-4">
            <h3 class="text-base font-bold text-gray-900">Daftar Ujian Tersedia</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-600 uppercase tracking-wider">
                            <th class="py-3 px-4">Nama Ujian</th>
                            <th class="py-3 px-4">Mata Pelajaran</th>
                            <th class="py-3 px-4 text-center">Export Laporan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @forelse ($ujians as $ujian)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3.5 px-4 font-bold text-gray-900">
                                    {{ $ujian->judul }}
                                </td>
                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    <span class="inline-block px-2.5 py-0.5 rounded text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                        {{ $ujian->mapel->nama_mapel ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('laporan.export-excel', $ujian->id) }}"
                                           class="bg-green-600 hover:bg-green-700 text-white font-semibold py-1.5 px-3 rounded-lg text-xs transition">
                                            Export Excel
                                        </a>

                                        <a href="{{ route('laporan.export-pdf', $ujian->id) }}" target="_blank"
                                           class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1.5 px-3 rounded-lg text-xs transition">
                                            Export PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-8 text-center text-gray-500 text-sm">
                                    Belum ada data ujian yang dibuat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
