<x-guest-layout>
    <!-- Compact Floating Box Container (Non Full Screen / Centered Floating Card) -->
    <div class="bg-white border border-slate-200/90 shadow-xl shadow-slate-300/30 rounded-3xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 min-h-[520px] transition-all duration-200">

        <!-- ========================================== -->
        <!-- A. LEFT / VISUAL BRANDING SECTION (50% Desktop) -->
        <!-- ========================================== -->
        <div class="hidden lg:flex lg:col-span-5 bg-gradient-to-br from-indigo-50/90 via-sky-50/70 to-slate-100/80 p-8 flex-col justify-between relative overflow-hidden border-r border-slate-200/60 select-none">
            
            <!-- Ambient Blur Decorations -->
            <div class="absolute -top-20 -left-20 w-52 h-52 bg-indigo-500/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -right-20 w-52 h-52 bg-sky-500/15 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Left Top Content: Headline -->
            <div class="relative z-10 space-y-3">
                <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-md border border-indigo-100/80 px-3 py-1 rounded-full text-[10px] font-extrabold text-indigo-700 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span>CBT Online System v2.0</span>
                </div>
                
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 leading-tight tracking-tight">
                    Evaluasi Ujian Digital <br>
                    <span class="text-indigo-600">Cepat</span> &amp; <span class="text-sky-600">Akurat</span>
                </h1>
                
                <p class="text-[11px] text-slate-600 font-medium leading-relaxed">
                    Sistem ujian berbasis komputer terintegrasi dengan penanganan skor otomatis dan rekapitulasi nilai real-time.
                </p>
            </div>

            <!-- Left Center Graphic: CBT Graphic Illustration Showcase -->
            <div class="relative z-10 py-4 my-auto flex justify-center">
                <div class="w-full max-w-[260px] bg-white/90 backdrop-blur-md rounded-2xl p-5 border border-white shadow-lg shadow-indigo-900/5 space-y-3 transform hover:scale-[1.02] transition duration-300">
                    <div class="flex items-center justify-between">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-sky-500 text-white font-black text-xl flex items-center justify-center shadow-md shadow-indigo-600/25">
                            📝
                        </div>
                        <span class="text-[9px] font-extrabold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                            AUTO-GRADING
                        </span>
                    </div>

                    <div class="space-y-0.5">
                        <div class="text-xs font-extrabold text-slate-900">Kalkulasi Skor Real-Time</div>
                        <div class="text-[10px] text-slate-500 font-medium leading-normal">
                            Nilai ujian langsung terhitung otomatis tepat setelah lembar ujian dikumpulkan.
                        </div>
                    </div>

                    <div class="space-y-1 pt-1">
                        <div class="flex justify-between text-[10px] font-bold text-slate-600">
                            <span>Akurasi Hasil Ujian</span>
                            <span class="text-indigo-600 font-mono font-extrabold">100%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-600 to-sky-500 h-full w-[100%] rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Feature Badges -->
            <div class="relative z-10 grid grid-cols-2 gap-2 text-[10px] font-bold text-slate-700">
                <div class="bg-white/80 backdrop-blur-md px-2.5 py-1.5 rounded-lg border border-white/80 flex items-center justify-center gap-1.5 shadow-2xs">
                    <span>🛡️</span> <span>Keamanan Ujian</span>
                </div>
                <div class="bg-white/80 backdrop-blur-md px-2.5 py-1.5 rounded-lg border border-white/80 flex items-center justify-center gap-1.5 shadow-2xs">
                    <span>📊</span> <span>Export Excel/PDF</span>
                </div>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- B. RIGHT / LOGIN FORM SECTION (7 Columns) -->
        <!-- ========================================== -->
        <div class="lg:col-span-7 bg-white p-6 sm:p-8 flex flex-col justify-between space-y-5"
             x-data="{
                 email: '{{ old('email') }}',
                 password: '',
                 remember: false,
                 showPassword: false,
                 isLoading: false,
                 emailTouched: false,
                 passwordTouched: false,
                 
                 get isEmailValid() {
                     const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                     return re.test(this.email);
                 },
                 get isPasswordValid() {
                     return this.password.length >= 1;
                 },
                 
                 submitForm(event) {
                     this.emailTouched = true;
                     this.passwordTouched = true;
                     
                     if (!this.isEmailValid || !this.isPasswordValid) {
                         event.preventDefault();
                         return false;
                     }
                     
                     this.isLoading = true;
                 },
                 fillDemo(demoEmail, demoPassword) {
                     this.email = demoEmail;
                     this.password = demoPassword;
                     this.emailTouched = true;
                     this.passwordTouched = true;
                 }
             }">

            <div class="w-full max-w-[380px] mx-auto space-y-5">

                <!-- 1. Brand Logo Mark -->
                <div class="flex items-center justify-between">
                    <a href="/login" class="inline-flex items-center gap-2 group focus:outline-none focus:ring-2 focus:ring-indigo-600 rounded-xl">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 to-indigo-700 text-white font-black text-lg flex items-center justify-center shadow-md shadow-indigo-600/20 group-hover:scale-105 transition duration-200">
                            🎓
                        </div>
                        <span class="font-black text-lg text-slate-900 tracking-tight">CBT <span class="text-indigo-600">Online</span></span>
                    </a>
                    <span class="text-[10px] font-bold text-slate-400">Portal Masuk</span>
                </div>

                <!-- 2 & 3. Heading & Subheading -->
                <div class="space-y-0.5">
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Welcome Back</h2>
                    <p class="text-xs text-slate-500 font-medium">Sign in to continue to your account.</p>
                </div>

                <!-- Alert Message Component (Error / Status) -->
                <x-auth-session-status class="mb-2" :status="session('status')" />

                @if ($errors->any())
                    <div class="p-3.5 bg-rose-50 border border-rose-200/80 rounded-xl text-xs space-y-1" role="alert">
                        <div class="font-extrabold text-rose-800 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Unable to sign in</span>
                        </div>
                        <p class="text-rose-700 font-medium pl-5">The email or password you entered is incorrect.</p>
                    </div>
                @endif

                <!-- Success Feedback Message -->
                <div x-show="isLoading" x-cloak class="p-3 bg-indigo-50 border border-indigo-200 rounded-xl text-xs font-bold text-indigo-700 flex items-center gap-2">
                    <svg class="w-4 h-4 animate-spin text-indigo-600" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span>Authenticating credentials. Redirecting...</span>
                </div>

                <!-- Form Login -->
                <form method="POST" action="{{ route('login') }}" @submit="submitForm($event)" class="space-y-3.5" novalidate>
                    @csrf

                    <!-- 4. Input Email Address -->
                    <div class="space-y-1">
                        <label for="email" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider">
                            Email Address <span class="text-rose-500">*</span>
                        </label>
                        
                        <div class="relative rounded-xl">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>

                            <input id="email"
                                   type="email"
                                   name="email"
                                   x-model="email"
                                   @blur="emailTouched = true"
                                   required
                                   autofocus
                                   autocomplete="username"
                                   placeholder="Enter your email"
                                   :class="{
                                       'border-rose-400 bg-rose-50/30 focus:border-rose-500 focus:ring-rose-500/20': emailTouched && !isEmailValid,
                                       'border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-600 focus:ring-indigo-600/20': !emailTouched || isEmailValid
                                   }"
                                   class="w-full pl-9 pr-3.5 py-2.5 rounded-xl text-xs text-slate-900 placeholder-slate-400 border transition duration-150 font-medium focus:outline-none focus:ring-2 disabled:opacity-50 disabled:cursor-not-allowed" />
                        </div>

                        <div x-show="emailTouched && !isEmailValid" x-cloak class="text-[11px] text-rose-600 font-semibold flex items-center gap-1 pt-0.5" role="alert">
                            <svg class="w-3.5 h-3.5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Please enter a valid email address.</span>
                        </div>
                    </div>

                    <!-- 5. Input Password -->
                    <div class="space-y-1">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider">
                                Password <span class="text-rose-500">*</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-[11px] text-indigo-600 font-extrabold hover:text-indigo-800 hover:underline transition focus:outline-none focus:ring-2 focus:ring-indigo-600 rounded" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <div class="relative rounded-xl">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>

                            <input id="password"
                                   :type="showPassword ? 'text' : 'password'"
                                   name="password"
                                   x-model="password"
                                   @blur="passwordTouched = true"
                                   required
                                   autocomplete="current-password"
                                   placeholder="Enter your password"
                                   :class="{
                                       'border-rose-400 bg-rose-50/30 focus:border-rose-500 focus:ring-rose-500/20': passwordTouched && !isPasswordValid,
                                       'border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-600 focus:ring-indigo-600/20': !passwordTouched || isPasswordValid
                                   }"
                                   class="w-full pl-9 pr-10 py-2.5 rounded-xl text-xs text-slate-900 placeholder-slate-400 border transition duration-150 font-medium focus:outline-none focus:ring-2 disabled:opacity-50 disabled:cursor-not-allowed" />

                            <button type="button"
                                    @click="showPassword = !showPassword"
                                    :disabled="isLoading"
                                    aria-label="Toggle password visibility"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none focus:text-indigo-600 transition">
                                <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.003 10.003 0 014.122-.988c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m-4.045-4.045a3 3 0 11-4.243-4.243m4.243 4.243L3 3l18 18" />
                                </svg>
                            </button>
                        </div>

                        <div x-show="passwordTouched && !isPasswordValid" x-cloak class="text-[11px] text-rose-600 font-semibold flex items-center gap-1 pt-0.5" role="alert">
                            <svg class="w-3.5 h-3.5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Password is required.</span>
                        </div>
                    </div>

                    <!-- 6. Checkbox: Remember me -->
                    <div class="flex items-center justify-between pt-0.5">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                            <input id="remember_me"
                                   type="checkbox"
                                   x-model="remember"
                                   name="remember"
                                   :disabled="isLoading"
                                   class="w-3.5 h-3.5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer transition">
                            <span class="ms-2 text-xs font-semibold text-slate-600">Remember me</span>
                        </label>
                    </div>

                    <!-- 8. Primary Button: Sign In / Loading State -->
                    <button type="submit"
                            :disabled="isLoading"
                            class="w-full h-11 bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 text-white font-extrabold rounded-xl text-xs transition duration-200 shadow-md shadow-indigo-600/25 active:scale-[0.99] flex items-center justify-center gap-2 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                        <template x-if="!isLoading">
                            <span class="flex items-center gap-2">
                                <span>Sign In</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </template>
                        <template x-if="isLoading">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 animate-spin text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                <span>Signing in...</span>
                            </span>
                        </template>
                    </button>
                </form>

                <!-- 9. Divider: OR -->
                <div class="relative flex items-center justify-center my-3">
                    <div class="border-t border-slate-200 w-full"></div>
                    <span class="bg-white px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-widest absolute">OR</span>
                </div>

                <!-- 10. Quick Demo Account Auto-Fill & Social Login -->
                <div class="space-y-1.5">
                    <div class="text-center">
                        <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">
                            ⚡ Quick Demo Account Auto-Fill
                        </span>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <button type="button" @click="fillDemo('admin@cbt.test', 'password')"
                                :disabled="isLoading"
                                class="px-2.5 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 border border-rose-200/80 text-rose-700 text-xs font-extrabold transition text-center shadow-2xs cursor-pointer flex flex-col items-center disabled:opacity-50">
                            <span class="text-[9px] text-rose-500 uppercase font-bold">Role</span>
                            <span>Admin</span>
                        </button>
                        <button type="button" @click="fillDemo('guru@cbt.test', 'password')"
                                :disabled="isLoading"
                                class="px-2.5 py-1.5 rounded-xl bg-indigo-50 hover:bg-indigo-100 border border-indigo-200/80 text-indigo-700 text-xs font-extrabold transition text-center shadow-2xs cursor-pointer flex flex-col items-center disabled:opacity-50">
                            <span class="text-[9px] text-indigo-500 uppercase font-bold">Role</span>
                            <span>Guru</span>
                        </button>
                        <button type="button" @click="fillDemo('siswa@cbt.test', 'password')"
                                :disabled="isLoading"
                                class="px-2.5 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-200/80 text-emerald-700 text-xs font-extrabold transition text-center shadow-2xs cursor-pointer flex flex-col items-center disabled:opacity-50">
                            <span class="text-[9px] text-emerald-500 uppercase font-bold">Role</span>
                            <span>Siswa</span>
                        </button>
                    </div>
                </div>

                <!-- 11. Registration Link -->
                <div class="text-center text-xs text-slate-500 font-medium pt-1">
                    <span>Don't have an account? </span>
                    <a href="{{ route('register') }}" class="text-indigo-600 font-extrabold hover:text-indigo-800 hover:underline transition focus:outline-none focus:ring-2 focus:ring-indigo-600 rounded">
                        Sign Up
                    </a>
                </div>

                <!-- 12. Small Footer Links -->
                <div class="pt-3 border-t border-slate-100 flex items-center justify-center gap-3 text-[10px] text-slate-400 font-medium">
                    <a href="#" class="hover:text-slate-600 hover:underline">Privacy Policy</a>
                    <span>&bull;</span>
                    <a href="#" class="hover:text-slate-600 hover:underline">Terms of Service</a>
                </div>

            </div>

        </div>
    </div>

    <script>
        function fillDemo(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
    </script>
</x-guest-layout>
