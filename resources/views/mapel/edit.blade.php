<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-gray-900 leading-tight">Edit Mata Pelajaran</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
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

            <form method="POST" action="{{ route('guru.mapel.update', $mapel->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Kode Mapel</label>
                    <input type="text" name="kode_mapel" value="{{ old('kode_mapel', $mapel->kode_mapel) }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 uppercase font-mono" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg text-xs transition">
                        Update Mapel
                    </button>
                    <a href="{{ route('guru.mapel.index') }}" class="text-xs text-gray-500 hover:underline">Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
