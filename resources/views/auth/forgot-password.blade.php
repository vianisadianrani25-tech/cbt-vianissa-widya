<x-guest-layout>
    <div class="bg-white border border-slate-200/80 shadow-2xl shadow-slate-300/40 rounded-3xl p-6 sm:p-10 max-w-md mx-auto space-y-6">

        <!-- Brand Mark & Back Link -->
        <div class="flex items-center justify-between">
            <a href="/login" class="inline-flex items-center gap-2 group text-xs font-bold text-indigo-600 hover:underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Sign In</span>
            </a>
            <span class="text-[11px] font-bold text-slate-400">Password Recovery</span>
        </div>

        <!-- Heading & Description -->
        <div class="space-y-1">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Forgot Password?</h2>
            <p class="text-xs text-slate-500 font-medium leading-relaxed">
                No problem. Enter your registered email address and we'll send you a link to reset your password.
            </p>
        </div>

        <!-- Session Status Alert -->
        <x-auth-session-status class="mb-2" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email Address Input -->
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Email Address <span class="text-rose-500">*</span>
                </label>
                
                <div class="relative rounded-2xl">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>

                    <input id="email"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           placeholder="Enter your email address"
                           class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150 font-medium" />
                </div>

                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-rose-600 font-semibold" />
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full h-12 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold rounded-2xl text-sm transition duration-200 shadow-md shadow-indigo-600/25 active:scale-[0.99] flex items-center justify-center gap-2 cursor-pointer">
                <span>Send Password Reset Link</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500 font-medium">
            Remember your password? <a href="{{ route('login') }}" class="text-indigo-600 font-extrabold hover:underline">Sign In</a>
        </div>

    </div>
</x-guest-layout>
