<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <h2 class="font-bold text-lg text-gray-900 leading-tight">Manajemen Sesi Ujian</h2>
                <p class="text-xs text-gray-500">Buat sesi ujian, terbitkan ujian, dan kelola susunan soal</p>
            </div>
            <a href="{{ route('guru.ujian.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs px-4 py-2 rounded-lg transition shadow-sm">
                + Buat Ujian Baru
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Daftar Sesi Ujian Cards -->
        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-bold text-gray-900">Daftar Sesi Ujian</h3>
                <span class="text-xs text-gray-500">Total: {{ $ujians->count() }} Ujian</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($ujians as $u)
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 space-y-3 flex flex-col justify-between">
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded border border-blue-100">
                                    {{ $u->mapel->nama_mapel ?? 'Umum' }}
                                </span>
                                @if($u->status === 'published')
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold bg-green-100 text-green-700 px-2 py-0.5 rounded border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> PUBLISHED (AKTIF)
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold bg-gray-200 text-gray-700 px-2 py-0.5 rounded border border-gray-300">
                                        DRAFT
                                    </span>
                                @endif
                            </div>

                            <h4 class="font-bold text-gray-900 text-base">{{ $u->judul }}</h4>
                            
                            <div class="text-xs text-gray-600 space-y-1">
                                <div>⏱️ Durasi: <strong>{{ $u->durasi_menit }} Menit</strong></div>
                                <div>📚 Terpasang: <strong class="text-blue-600">{{ $u->soals->count() }} Soal</strong></div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-3 border-t border-gray-200 flex items-center justify-between gap-2">
                            <form action="{{ route('guru.ujian.toggle-status', $u->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="text-xs font-semibold px-2.5 py-1 rounded border {{ $u->status === 'published' ? 'bg-amber-50 text-amber-700 border-amber-200 hover:bg-amber-100' : 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100' }}">
                                    {{ $u->status === 'published' ? 'Ubah ke Draft' : 'Terbitkan (Publish)' }}
                                </button>
                            </form>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('guru.ujian.edit', $u->id) }}" class="text-xs font-semibold text-yellow-700 bg-yellow-50 hover:bg-yellow-100 px-2.5 py-1 rounded border border-yellow-200">
                                    Edit Ujian & Soal
                                </a>
                                <form action="{{ route('guru.ujian.destroy', $u->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus sesi ujian ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100 px-2.5 py-1 rounded border border-red-200">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-8 text-center text-xs text-gray-500">
                        Belum ada sesi ujian. Klik tombol "+ Buat Ujian Baru" di atas.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>