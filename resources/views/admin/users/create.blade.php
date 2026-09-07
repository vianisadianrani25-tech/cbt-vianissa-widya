<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-gray-900 leading-tight">Tambah User Baru</h2>
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

            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Ahmad Rizky" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="user@cbt.test" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">NIS / NIP (Opsional)</label>
                    <input type="text" name="nis" value="{{ old('nis') }}" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="2026001">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Role Pengguna</label>
                    <select name="role" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Password</label>
                    <input type="password" name="password" class="w-full border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Minimal 6 karakter" required>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg text-xs transition">
                        Simpan User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="text-xs text-gray-500 hover:underline">Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
