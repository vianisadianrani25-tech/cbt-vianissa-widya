<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30 shadow-xs">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @php
                        $dashboardRoute = match(Auth::user()->role) {
                            'admin' => route('admin.dashboard'),
                            'guru' => route('guru.dashboard'),
                            'siswa' => route('siswa.dashboard'),
                            default => route('login')
                        };
                    @endphp
                    <a href="{{ $dashboardRoute }}" class="flex items-center gap-2.5 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-600 text-white font-extrabold text-lg flex items-center justify-center shadow-md shadow-indigo-500/20 group-hover:scale-105 transition duration-200">
                            C
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-slate-900 text-base tracking-tight leading-none">CBT <span class="text-indigo-600">Online</span></span>
                            <span class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase">Exam System</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:flex sm:items-center">
                    <a href="{{ $dashboardRoute }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition duration-150 {{ request()->routeIs('*.dashboard') ? 'bg-indigo-50 text-indigo-700 shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        Dashboard
                    </a>

                    @if(Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.users.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition duration-150 {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700 shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            Kelola Pengguna
                        </a>
                    @endif

                    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('guru'))
                        <a href="{{ route('guru.soal.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition duration-150 {{ request()->routeIs('guru.soal.*') ? 'bg-indigo-50 text-indigo-700 shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            Bank Soal
                        </a>
                        <a href="{{ route('guru.mapel.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition duration-150 {{ request()->routeIs('guru.mapel.*') ? 'bg-indigo-50 text-indigo-700 shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            Mata Pelajaran
                        </a>
                        <a href="{{ route('guru.ujian.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition duration-150 {{ request()->routeIs('guru.ujian.*') ? 'bg-indigo-50 text-indigo-700 shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            Rangkai Ujian
                        </a>
                        <a href="{{ route('laporan.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition duration-150 {{ request()->routeIs('laporan.*') || request()->routeIs('guru.laporan.*') ? 'bg-indigo-50 text-indigo-700 shadow-xs' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            Laporan Nilai
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <!-- Role Badge -->
                <div>
                    @if(Auth::user()->hasRole('admin'))
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200/80 shadow-xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> ADMIN
                        </span>
                    @elseif(Auth::user()->hasRole('guru'))
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200/80 shadow-xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> GURU
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/80 shadow-xs">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> SISWA
                        </span>
                    @endif
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-1.5 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 bg-white hover:bg-slate-50 hover:border-slate-300 focus:outline-none transition duration-150 shadow-xs">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil Saya') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-600 font-bold">
                                {{ __('Keluar / Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-slate-100 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-slate-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ $dashboardRoute }}" class="block px-3 py-2 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-100">
                Dashboard
            </a>
            @if(Auth::user()->hasRole('admin'))
                <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-100">
                    Kelola Pengguna
                </a>
            @endif
            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('guru'))
                <a href="{{ route('guru.soal.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-100">
                    Bank Soal
                </a>
                <a href="{{ route('guru.mapel.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-100">
                    Mata Pelajaran
                </a>
                <a href="{{ route('guru.ujian.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-100">
                    Rangkai Ujian
                </a>
                <a href="{{ route('laporan.index') }}" class="block px-3 py-2 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-100">
                    Laporan Nilai
                </a>
            @endif
        </div>

        <div class="pt-4 pb-3 border-t border-slate-200 px-4">
            <div class="font-extrabold text-slate-900 text-sm">{{ Auth::user()->name }}</div>
            <div class="text-xs text-slate-500 font-mono">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-100">
                    Profil Saya
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block px-3 py-2 rounded-xl text-xs font-bold text-rose-600 hover:bg-rose-50">
                        Keluar / Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
