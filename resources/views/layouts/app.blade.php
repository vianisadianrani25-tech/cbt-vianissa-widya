<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CBT Online') }} — Sistem Ujian Digital</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased text-slate-800 bg-slate-50 min-h-full selection:bg-indigo-500 selection:text-white">
        <div class="min-h-screen flex flex-col bg-slate-50">
            
            <!-- Main Navigation Bar -->
            @include('layouts.navigation')

            <!-- Page Heading Banner -->
            @isset($header)
                <header class="bg-white border-b border-slate-200/80 py-4 shadow-sm sticky top-16 z-20 backdrop-blur-md bg-white/95">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow py-8">
                {{ $slot }}
            </main>

            <!-- System Footer -->
            <footer class="bg-white border-t border-slate-200/80 py-4 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-2">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-slate-800">CBT Online Exam System</span>
                        <span>&bull;</span>
                        <span>&copy; {{ date('Y') }} All Rights Reserved</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full font-semibold text-[11px] border border-emerald-200/80">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> System Operational
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
