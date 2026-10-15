<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>NursePulse Academy - Platform Pendidikan &amp; Akreditasi Keperawatan Klinis</title>

    <!-- Google Fonts: Manrope (Body) & Plus Jakarta Sans (Headings) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Material Symbols Icons (Outlined & Variable Fill) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />

    <!-- Tailwind CSS with Exact Google Stitch Design Tokens -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'background': '#F8F9FA',
                        'surface-card-white': '#FFFFFF',
                        'surface-container-lowest': '#FFFFFF',
                        'surface-container-low': '#F3F4F6',
                        'surface-container': '#E5E7EB',
                        'surface-container-high': '#D1D5DB',
                        'surface-bright': '#FFFFFF',
                        'carbon-black': '#0F1417',
                        'soft-gray': '#E2E8F0',
                        'royal-purple': '#6045F4',
                        'primary': '#6045F4',
                        'primary-container': '#7C64F6',
                        'primary-fixed': '#E8E5FE',
                        'secondary': '#00877A',
                        'neon-mint': '#53E6D4',
                        'secondary-fixed': '#C6F8F2',
                        'secondary-fixed-dim': '#53E6D4',
                        'ce-credit-gold': '#F59E0B',
                        'clinical-danger': '#EF4444',
                        'error-container': '#FEE2E2',
                        'on-surface': '#0F1417',
                        'on-surface-variant': '#475569',
                        'outline': '#94A3B8',
                        'outline-variant': '#CBD5E1',
                    },
                    fontFamily: {
                        'headline-lg': ['"Plus Jakarta Sans"', 'sans-serif'],
                        'headline-md': ['"Plus Jakarta Sans"', 'sans-serif'],
                        'headline-sm': ['"Plus Jakarta Sans"', 'sans-serif'],
                        'title-md': ['"Plus Jakarta Sans"', 'sans-serif'],
                        'body-md': ['"Manrope"', 'sans-serif'],
                        'body-sm': ['"Manrope"', 'sans-serif'],
                        'label-md': ['"Manrope"', 'sans-serif'],
                        'label-caps': ['"Plus Jakarta Sans"', 'sans-serif'],
                        'metric-digit': ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    fontSize: {
                        'headline-lg': ['28px', { lineHeight: '36px', fontWeight: '800' }],
                        'headline-md': ['22px', { lineHeight: '28px', fontWeight: '700' }],
                        'headline-sm': ['18px', { lineHeight: '24px', fontWeight: '700' }],
                        'title-md': ['15px', { lineHeight: '20px', fontWeight: '600' }],
                        'body-md': ['14px', { lineHeight: '20px', fontWeight: '400' }],
                        'body-sm': ['13px', { lineHeight: '18px', fontWeight: '400' }],
                        'label-md': ['13px', { lineHeight: '18px', fontWeight: '600' }],
                        'label-caps': ['11px', { lineHeight: '14px', fontWeight: '700', letterSpacing: '0.04em' }],
                        'metric-digit': ['24px', { lineHeight: '28px', fontWeight: '800' }],
                    },
                    spacing: {
                        'gutter-desktop': '32px',
                        'gutter-tablet': '24px',
                        'gutter-mobile': '16px',
                        'space-xs': '4px',
                        'space-sm': '8px',
                        'space-md': '16px',
                        'space-lg': '24px',
                        'space-xl': '32px',
                    },
                    borderRadius: {
                        'card': '16px',
                        'button': '8px',
                        'badge': '9999px',
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }

        body {
            font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class="bg-background font-body-md text-body-md text-on-surface antialiased">

    <!-- Header / Top Navigation Bar (Stitch Design) -->
    <header
        class="fixed top-0 left-0 right-0 z-50 bg-surface-card-white/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(15,20,23,0.04)]">
        <div
            class="h-20 w-full px-4 sm:px-6 lg:px-gutter-desktop flex items-center justify-between gap-space-md max-w-[1440px] mx-auto">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="flex items-center min-w-max">
                <img alt="NursePulse Academy Logo" class="h-11 w-auto object-contain"
                    src="{{ asset('logo/logo.png') }}">
            </a>

            <!-- Search Bar -->
            <div class="flex-1 max-w-xl mx-space-md hidden md:block">
                <div class="relative flex items-center w-full">
                    <span
                        class="material-symbols-outlined absolute left-space-sm text-outline pointer-events-none text-[20px]">search</span>
                    <input
                        class="w-full h-10 pl-10 pr-space-md rounded-lg bg-surface-container-low text-carbon-black placeholder:text-outline text-body-sm font-body-sm focus:outline-none focus:bg-surface-card-white shadow-[0_0_0_1px_rgba(15,20,23,0.08)] focus:shadow-[0_0_0_2px_#6045F4] transition-all"
                        placeholder="Cari modul klinis, BHD, pemasangan infus, SOP keperawatan..." type="text">
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="hidden xl:flex items-center gap-space-lg">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="transition-colors text-royal-purple font-label-md font-bold flex items-center gap-1">
                        <span class="material-symbols-outlined text-[18px]">dashboard</span> My Learning
                    </a>
                @endauth
                <a href="#modul-pembelajaran"
                    class="text-on-surface-variant hover:text-royal-purple font-label-md text-label-md transition-colors">Modul Pelatihan</a>
                <a href="#alur-belajar"
                    class="text-on-surface-variant hover:text-royal-purple font-label-md text-label-md transition-colors">Alur 90 Hari</a>
                <a href="{{ route('schedule.index') }}"
                    class="text-on-surface-variant hover:text-royal-purple font-label-md text-label-md transition-colors">Kalender Belajar</a>
                <a href="#tentang-program"
                    class="text-on-surface-variant hover:text-royal-purple font-label-md text-label-md transition-colors">Tentang Program</a>
            </nav>

            <!-- Right Actions -->
            <div class="flex items-center gap-space-sm min-w-max">
                @auth
                    <!-- 90 Days Badge -->
                    <a href="{{ route('schedule.index') }}"
                        class="hidden sm:flex items-center gap-space-xs bg-surface-container-low px-space-sm py-1.5 rounded-full shadow-[0_0_0_1px_rgba(15,20,23,0.06)] hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-neon-mint text-[18px]"
                            style="font-variation-settings: 'FILL' 1;">verified</span>
                        <div class="flex flex-col">
                            <span
                                class="font-label-caps text-label-caps text-carbon-black font-bold leading-none">{{ auth()->user()->getActiveDaysCount() }}/90
                                Hari</span>
                            <span class="font-label-caps text-[9px] text-outline leading-tight">AKUMULASI AKTIF</span>
                        </div>
                    </a>

                    <!-- User Profile Dropdown -->
                    <div class="relative" id="userMenuContainer">
                        <button onclick="document.getElementById('userDropdown').classList.toggle('hidden')"
                            class="flex items-center gap-space-xs pl-space-xs focus:outline-none cursor-pointer">
                            <img alt="Profile" class="w-9 h-9 rounded-full object-cover ring-2 ring-royal-purple/20"
                                src="{{ auth()->user()->profile?->photo ? asset('storage/' . auth()->user()->profile->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=6045F4&color=ffffff&bold=true' }}">
                            <div class="hidden lg:flex flex-col text-left">
                                <span
                                    class="font-label-md text-label-md text-carbon-black leading-tight font-bold">{{ auth()->user()->profile->full_name ?? auth()->user()->name }}</span>
                                <span
                                    class="font-label-caps text-[10px] text-royal-purple font-semibold leading-tight uppercase">{{ auth()->user()->isAdmin() ? 'ADMINISTRATOR' : (auth()->user()->profile?->hospital ? Str::limit(auth()->user()->profile->hospital, 18) : 'PERAWAT KLINIS') }}</span>
                            </div>
                        </button>
                        <div id="userDropdown"
                            class="hidden absolute right-0 mt-2 w-52 bg-surface-card-white rounded-xl shadow-xl border border-soft-gray py-2 z-50">
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-carbon-black hover:bg-surface-container-low transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-royal-purple">dashboard</span> My Learning
                            </a>
                            <a href="{{ route('courses.index') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-carbon-black hover:bg-surface-container-low transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-royal-purple">school</span> Modul Materi
                            </a>
                            <a href="{{ route('schedule.index') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-carbon-black hover:bg-surface-container-low transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-royal-purple">calendar_month</span> Target 90 Hari
                            </a>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-clinical-danger hover:bg-red-50 transition-colors font-semibold">
                                    <span class="material-symbols-outlined text-[18px]">admin_panel_settings</span> Panel Admin
                                </a>
                            @endif
                            <div class="border-t border-soft-gray my-1"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-2 px-4 py-2 text-sm text-clinical-danger hover:bg-error-container/30 transition-colors text-left font-semibold">
                                    <span class="material-symbols-outlined text-[18px]">logout</span> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-surface-container-low text-carbon-black font-label-caps text-xs font-semibold shadow-[0_0_0_1px_rgba(15,20,23,0.06)]">
                        <span class="w-2 h-2 rounded-full bg-neon-mint"></span>
                        Program 90 Hari Aktif
                    </span>
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded-lg bg-surface-container-low text-carbon-black font-label-md text-sm font-bold hover:bg-surface-container transition-all border border-soft-gray">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 rounded-lg bg-royal-purple text-surface-card-white font-label-md text-sm font-bold hover:bg-primary transition-all shadow-md shadow-royal-purple/20">Daftar Akun</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Body Container -->
    <main class="w-full pt-20 bg-background min-h-screen">
        <div class="flex flex-col w-full">
            <div class="w-full px-4 sm:px-6 lg:px-8 py-6 max-w-[1440px] mx-auto space-y-12">

                <!-- ======================================================== -->
                <!-- 1. Hero & Program Master Banner (Stitch Design) -->
                <!-- ======================================================== -->
                <section
                    class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-carbon-black via-[#1a1738] to-carbon-black text-surface-card-white shadow-xl">
                    <div
                        class="absolute -right-16 -top-24 w-96 h-96 bg-royal-purple/20 rounded-full blur-3xl pointer-events-none">
                    </div>
                    <div
                        class="absolute right-1/3 -bottom-20 w-80 h-80 bg-neon-mint/10 rounded-full blur-2xl pointer-events-none">
                    </div>
                    <div
                        class="relative p-6 sm:p-8 lg:p-10 flex flex-col xl:flex-row items-start xl:items-center justify-between gap-8">
                        <div class="flex-1 space-y-5 max-w-3xl">
                            <div class="flex flex-wrap items-center gap-3">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-neon-mint text-carbon-black font-label-caps text-label-caps tracking-wider uppercase shadow-sm font-bold">
                                    <span class="material-symbols-outlined text-sm font-bold"
                                        style="font-variation-settings: 'FILL' 1;">verified</span>
                                    NursePulse Academy
                                </span>
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-surface-card-white/10 text-surface-bright font-label-caps text-label-caps backdrop-blur-md">
                                    <span class="w-1.5 h-1.5 rounded-full bg-neon-mint"></span>
                                    Target 90 Hari Aktif Belajar Menuju Sertifikat
                                </span>
                            </div>

                            <div class="space-y-2">
                                @auth
                                    <h1
                                        class="font-headline-lg text-headline-lg sm:text-[34px] tracking-tight text-surface-card-white font-extrabold">
                                        Selamat Datang Kembali, {{ auth()->user()->profile->full_name ?? auth()->user()->name }}
                                    </h1>
                                    <p class="font-body-md text-body-md text-surface-variant font-medium">
                                        {{ auth()->user()->profile?->hospital ?? 'Pelatihan Klinis Keperawatan Mandiri' }} • Lanjutkan video modul atau pantau akumulasi hari aktif belajar Anda.
                                    </p>
                                @else
                                    <h1
                                        class="font-headline-lg text-headline-lg sm:text-[34px] tracking-tight text-surface-card-white font-extrabold">
                                        Tingkatkan Kompetensi Keperawatan Klinis dengan Kurikulum Berstandar
                                    </h1>
                                    <p class="font-body-md text-body-md text-surface-variant font-medium">
                                        Platform pembelajaran mandiri berbasis alur materi video bertahap, evaluasi kuisioner berstandar nilai kelulusan, dan akumulasi 90 hari aktif belajar untuk penerbitan sertifikat resmi.
                                    </p>
                                @endauth
                            </div>

                            <div class="flex flex-wrap items-center gap-4 pt-2">
                                @auth
                                    <a class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-royal-purple hover:bg-primary text-surface-card-white font-label-md text-label-md transition-all duration-200 shadow-lg shadow-royal-purple/30 font-bold"
                                        href="{{ route('dashboard') }}">
                                        <span class="material-symbols-outlined text-[18px]">dashboard</span>
                                        Buka Dashboard Belajar
                                    </a>
                                    <a class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-surface-card-white/10 hover:bg-surface-card-white/20 text-surface-card-white font-label-md text-label-md backdrop-blur-sm transition-all duration-200 font-semibold"
                                        href="#modul-pembelajaran">
                                        <span class="material-symbols-outlined text-[18px]">play_circle</span>
                                        Lanjutkan Modul
                                    </a>
                                @else
                                    <a class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-royal-purple hover:bg-primary text-surface-card-white font-label-md text-label-md transition-all duration-200 shadow-lg shadow-royal-purple/30 font-bold"
                                        href="{{ route('register') }}">
                                        <span class="material-symbols-outlined text-[18px]">how_to_reg</span>
                                        Daftar &amp; Mulai Belajar
                                    </a>
                                    <a class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-surface-card-white/10 hover:bg-surface-card-white/20 text-surface-card-white font-label-md text-label-md backdrop-blur-sm transition-all duration-200 font-semibold"
                                        href="#modul-pembelajaran">
                                        <span class="material-symbols-outlined text-[18px]">menu_book</span>
                                        Eksplorasi Modul
                                    </a>
                                @endauth
                            </div>
                        </div>

                        <!-- Right Banner Card: Status / Alur Program 90 Hari -->
                        <div
                            class="w-full xl:w-96 p-6 rounded-xl bg-surface-card-white/5 backdrop-blur-md shadow-inner space-y-4 border border-surface-card-white/10">
                            @auth
                                @php
                                    $userActiveDays = auth()->user()->getActiveDaysCount();
                                    $userPercent = min(100, round(($userActiveDays / 90) * 100));
                                @endphp
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-ce-credit-gold text-[22px]">workspace_premium</span>
                                        <span class="font-title-md text-title-md font-bold text-surface-card-white">Progres Belajar Anda</span>
                                    </div>
                                    <span class="font-metric-digit text-metric-digit text-neon-mint leading-none font-black">{{ $userPercent }}%</span>
                                </div>
                                <div class="space-y-1.5">
                                    <div class="flex justify-between font-label-caps text-label-caps text-surface-variant">
                                        <span>Target: 90 Hari Aktif</span>
                                        <span class="text-surface-card-white font-bold">{{ $userActiveDays }} / 90 Hari</span>
                                    </div>
                                    <div class="w-full h-3 rounded-full bg-surface-card-white/10 overflow-hidden p-0.5">
                                        <div class="h-full bg-gradient-to-r from-royal-purple via-secondary to-neon-mint rounded-full transition-all duration-500" style="width: {{ $userPercent }}%"></div>
                                    </div>
                                </div>
                                <div class="pt-2 flex items-center justify-between font-body-sm text-body-sm text-surface-variant">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-neon-mint">task_alt</span>
                                        Sistem Akumulatif
                                    </span>
                                    <span class="text-neon-mint font-semibold">Sisa {{ max(0, 90 - $userActiveDays) }} Hari</span>
                                </div>
                            @else
                                <div class="flex items-center justify-between pb-2 border-b border-surface-card-white/10">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-ce-credit-gold text-[22px]">workspace_premium</span>
                                        <span class="font-title-md text-title-md font-bold text-surface-card-white">Syarat Kelulusan</span>
                                    </div>
                                    <span class="px-2 py-0.5 rounded bg-neon-mint text-carbon-black font-label-caps text-[10px] font-bold">RESMI</span>
                                </div>
                                <ul class="space-y-2.5 text-xs text-surface-variant font-medium">
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-neon-mint text-sm shrink-0 mt-0.5">check_circle</span>
                                        <span>Tonton video materi hingga 100% tuntas</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-neon-mint text-sm shrink-0 mt-0.5">check_circle</span>
                                        <span>Kerjakan kuisioner evaluasi pemahaman</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-neon-mint text-sm shrink-0 mt-0.5">check_circle</span>
                                        <span>Capai nilai di atas passing score</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-neon-mint text-sm shrink-0 mt-0.5">check_circle</span>
                                        <span>Akumulasi 90 hari aktif belajar harian</span>
                                    </li>
                                </ul>
                                <div class="pt-2 border-t border-surface-card-white/10 flex items-center justify-between text-xs text-surface-card-white">
                                    <span class="text-surface-variant">Sertifikat:</span>
                                    <span class="text-neon-mint font-bold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">verified</span> Terbit Otomatis
                                    </span>
                                </div>
                            @endauth
                        </div>
                    </div>
                </section>

                <!-- ======================================================== -->
                <!-- 2. Real Stat Strip (Platform Metrics) -->
                <!-- ======================================================== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div
                        class="p-5 rounded-xl bg-surface-card-white shadow-sm flex items-center gap-4 transition-all duration-200 hover:shadow-md border border-soft-gray/60">
                        <div
                            class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-royal-purple shrink-0">
                            <span class="material-symbols-outlined text-[26px]">school</span>
                        </div>
                        <div>
                            <div
                                class="font-metric-digit text-metric-digit text-carbon-black font-extrabold leading-tight">
                                {{ $totalCourses }} Modul</div>
                            <div class="font-body-sm text-xs text-on-surface-variant">Kurikulum Pelatihan Klinis
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-5 rounded-xl bg-surface-card-white shadow-sm flex items-center gap-4 transition-all duration-200 hover:shadow-md border border-soft-gray/60">
                        <div
                            class="w-12 h-12 rounded-xl bg-secondary-fixed flex items-center justify-center text-secondary shrink-0">
                            <span class="material-symbols-outlined text-[26px]">play_circle</span>
                        </div>
                        <div>
                            <div
                                class="font-metric-digit text-metric-digit text-carbon-black font-extrabold leading-tight">
                                {{ $totalVideos }} Video</div>
                            <div class="font-body-sm text-xs text-on-surface-variant">Materi Klinis Bertahap
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-5 rounded-xl bg-surface-card-white shadow-sm flex items-center gap-4 transition-all duration-200 hover:shadow-md border border-soft-gray/60">
                        <div
                            class="w-12 h-12 rounded-xl bg-neon-mint/30 flex items-center justify-center text-secondary shrink-0">
                            <span class="material-symbols-outlined text-[26px]">quiz</span>
                        </div>
                        <div>
                            <div
                                class="font-metric-digit text-metric-digit text-carbon-black font-extrabold leading-tight">
                                {{ $totalQuestionnaires }} Evaluasi</div>
                            <div class="font-body-sm text-xs text-on-surface-variant">Kuis dengan Passing Score
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-5 rounded-xl bg-surface-card-white shadow-sm flex items-center gap-4 transition-all duration-200 hover:shadow-md border border-soft-gray/60">
                        <div
                            class="w-12 h-12 rounded-xl bg-error-container flex items-center justify-center text-clinical-danger shrink-0">
                            <span class="material-symbols-outlined text-[26px]">calendar_month</span>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span
                                    class="font-metric-digit text-metric-digit text-carbon-black font-extrabold leading-tight">90</span>
                                <span
                                    class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-label-caps font-bold bg-neon-mint text-carbon-black">HARI</span>
                            </div>
                            <div class="font-body-sm text-xs text-on-surface-variant">Target Akumulasi Sertifikat
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ======================================================== -->
                <!-- 3. Modul Pembelajaran Klinis (Real Data from Database) -->
                <!-- ======================================================== -->
                <section class="space-y-4" id="modul-pembelajaran">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <h2 class="font-headline-md text-headline-md font-bold text-carbon-black">Modul Pembelajaran Klinis</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">
                                Tonton seluruh video materi secara berurutan untuk membuka kuisioner evaluasi pemahaman klinis Anda.
                            </p>
                        </div>
                        <a class="font-label-md text-label-md text-royal-purple hover:text-primary font-bold flex items-center gap-1 w-fit"
                            href="{{ route('courses.index') }}">
                            Semua Modul Aktif
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-6">
                        @forelse($courses as $course)
                            <div
                                class="group flex flex-col justify-between rounded-xl bg-surface-card-white shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-soft-gray/70">
                                <div>
                                    <!-- Card Header & Thumbnail -->
                                    <div class="relative h-44 w-full overflow-hidden bg-gradient-to-tr from-carbon-black via-[#1a1738] to-carbon-black flex items-center justify-center">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            alt="{{ $course->title }}"
                                            src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('cover course/cover.jpg') }}">
                                        <div class="absolute inset-0 bg-gradient-to-t from-carbon-black/80 via-transparent to-transparent"></div>
                                        
                                        <!-- Video Count Badge -->
                                        <div class="absolute top-3 right-3 bg-carbon-black/80 backdrop-blur-md px-2.5 py-1 rounded-full text-xs font-label-caps text-surface-card-white flex items-center gap-1 font-semibold">
                                            <span class="material-symbols-outlined text-neon-mint text-[14px]">subscriptions</span>
                                            <span>{{ $course->video_count }} Video</span>
                                        </div>

                                        <!-- Badge Status Alur -->
                                        <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-surface-card-white font-label-caps text-label-caps">
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-carbon-black/80 text-surface-variant backdrop-blur-md text-[10px]">
                                                <span class="material-symbols-outlined text-[12px] text-neon-mint">lock</span>
                                                Prasyarat Kuis
                                            </span>
                                            <span class="text-neon-mint font-semibold text-[11px]">Video Wajib 100%</span>
                                        </div>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="p-5 space-y-3">
                                        <div class="space-y-1">
                                            <span class="font-label-caps text-[10px] text-royal-purple uppercase tracking-wider font-bold">MODUL #{{ $course->order_number ?? $loop->iteration }}</span>
                                            <h3 class="font-headline-sm text-base font-bold text-carbon-black group-hover:text-royal-purple transition-colors line-clamp-2">
                                                {{ $course->title }}
                                            </h3>
                                        </div>
                                        <p class="font-body-sm text-xs text-on-surface-variant line-clamp-2">
                                            {{ $course->description }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Card Footer & Action -->
                                <div class="p-5 pt-0 space-y-3">
                                    <div class="p-2.5 rounded-lg bg-surface-container-low text-xs text-on-surface-variant flex items-center justify-between">
                                        <span class="flex items-center gap-1 font-medium">
                                            <span class="material-symbols-outlined text-[14px] text-royal-purple">quiz</span>
                                            Kuisioner Evaluasi:
                                        </span>
                                        <span class="font-bold text-carbon-black">Passing Score</span>
                                    </div>

                                    @auth
                                        <a class="w-full py-2.5 px-4 rounded-lg bg-royal-purple hover:bg-primary text-surface-card-white font-label-md text-xs flex items-center justify-center gap-2 transition-colors font-bold shadow-sm"
                                            href="{{ route('courses.show', $course) }}">
                                            <span>Buka Modul Pembelajaran</span>
                                            <span class="material-symbols-outlined text-sm">play_arrow</span>
                                        </a>
                                    @else
                                        <a class="w-full py-2.5 px-4 rounded-lg bg-royal-purple hover:bg-primary text-surface-card-white font-label-md text-xs flex items-center justify-center gap-2 transition-colors font-bold shadow-sm"
                                            href="{{ route('register') }}">
                                            <span>Mulai Pelajari Modul</span>
                                            <span class="material-symbols-outlined text-sm">play_arrow</span>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 bg-surface-card-white rounded-xl border border-soft-gray">
                                <span class="material-symbols-outlined text-[48px] text-outline mb-2">menu_book</span>
                                <p class="text-on-surface-variant font-medium">Belum ada modul aktif saat ini.</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                <!-- ======================================================== -->
                <!-- 4. Panduan 4 Pilar Alur Pembelajaran & Kelulusan -->
                <!-- ======================================================== -->
                <section class="space-y-6" id="alur-belajar">
                    <div class="space-y-1">
                        <h2 class="font-headline-md text-headline-md font-bold text-carbon-black">Alur Pembelajaran &amp; Syarat Kelulusan Program</h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                            Empat pilar utama sistem pembelajaran NursePulse Academy yang dirancang untuk menjaga kualitas kompetensi dan konsistensi Anda.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Pillar 1 -->
                        <div class="p-6 rounded-xl bg-surface-card-white border border-soft-gray/70 shadow-sm space-y-4 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-royal-purple font-headline-sm font-extrabold">
                                01
                            </div>
                            <div class="space-y-2">
                                <h3 class="font-title-md text-base font-bold text-carbon-black flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-royal-purple text-lg">play_circle</span>
                                    Tonton Video 100%
                                </h3>
                                <p class="font-body-sm text-xs text-on-surface-variant leading-relaxed">
                                    Pelajari setiap video pembelajaran modul klinis hingga tuntas. Sistem mengharuskan seluruh video selesai sebagai prasyarat wajib membuka evaluasi.
                                </p>
                            </div>
                            <div class="pt-2 border-t border-soft-gray text-[11px] font-label-caps text-royal-purple font-bold">
                                PRASYARAT WAJIB
                            </div>
                        </div>

                        <!-- Pillar 2 -->
                        <div class="p-6 rounded-xl bg-surface-card-white border border-soft-gray/70 shadow-sm space-y-4 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 rounded-xl bg-secondary-fixed flex items-center justify-center text-secondary font-headline-sm font-extrabold">
                                02
                            </div>
                            <div class="space-y-2">
                                <h3 class="font-title-md text-base font-bold text-carbon-black flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-secondary text-lg">quiz</span>
                                    Evaluasi &amp; Kuis
                                </h3>
                                <p class="font-body-sm text-xs text-on-surface-variant leading-relaxed">
                                    Kerjakan kuisioner evaluasi pemahaman klinis yang terdiri dari soal pilihan ganda atau esai. Anda harus melampaui batas nilai kelulusan (passing score).
                                </p>
                            </div>
                            <div class="pt-2 border-t border-soft-gray text-[11px] font-label-caps text-secondary font-bold">
                                STANDAR PASSING SCORE
                            </div>
                        </div>

                        <!-- Pillar 3 -->
                        <div class="p-6 rounded-xl bg-surface-card-white border border-soft-gray/70 shadow-sm space-y-4 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 rounded-xl bg-neon-mint/30 flex items-center justify-center text-secondary font-headline-sm font-extrabold">
                                03
                            </div>
                            <div class="space-y-2">
                                <h3 class="font-title-md text-base font-bold text-carbon-black flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-secondary text-lg">calendar_month</span>
                                    Akumulasi 90 Hari
                                </h3>
                                <p class="font-body-sm text-xs text-on-surface-variant leading-relaxed">
                                    Lakukan aktivitas belajar minimal 90 hari secara akumulatif. Anda bebas belajar sesuai ritme; hari absen tidak mereset hari aktif yang sudah Anda kumpulkan.
                                </p>
                            </div>
                            <div class="pt-2 border-t border-soft-gray text-[11px] font-label-caps text-secondary font-bold">
                                FLEKSIBEL &amp; AKUMULATIF
                            </div>
                        </div>

                        <!-- Pillar 4 -->
                        <div class="p-6 rounded-xl bg-surface-card-white border border-soft-gray/70 shadow-sm space-y-4 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 rounded-xl bg-error-container flex items-center justify-center text-clinical-danger font-headline-sm font-extrabold">
                                04
                            </div>
                            <div class="space-y-2">
                                <h3 class="font-title-md text-base font-bold text-carbon-black flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-clinical-danger text-lg">workspace_premium</span>
                                    Sertifikat Otomatis
                                </h3>
                                <p class="font-body-sm text-xs text-on-surface-variant leading-relaxed">
                                    Setelah target akumulasi 90 hari aktif belajar terpenuhi, tombol klaim sertifikat kelulusan resmi akan otomatis aktif di dashboard untuk Anda unduh kapan saja.
                                </p>
                            </div>
                            <div class="pt-2 border-t border-soft-gray text-[11px] font-label-caps text-clinical-danger font-bold">
                                PENERBITAN OTOMATIS
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ======================================================== -->
                <!-- 5. Penjelasan Kalender 90 Hari & Sistem Streak -->
                <!-- ======================================================== -->
                <section class="rounded-xl bg-surface-card-white p-6 sm:p-8 shadow-sm border border-soft-gray/70 space-y-6" id="tentang-program">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        <div class="space-y-3 max-w-2xl">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container text-royal-purple font-label-caps text-xs font-bold">
                                <span class="material-symbols-outlined text-sm">verified</span>
                                SISTEM KELULUSAN TERSTRUKTUR
                            </div>
                            <h2 class="font-headline-md text-xl sm:text-2xl font-bold text-carbon-black">
                                Bagaimana Sistem Akumulasi 90 Hari Bekerja?
                            </h2>
                            <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                                Program sertifikasi ini menekankan pembentukan kebiasaan belajar kontinu. Anda tidak dituntut belajar 90 hari berturut-turut tanpa jeda; setiap kali Anda menonton video atau menyelesaikan kuis, sistem akan menandai 1 hari aktif belajar.
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                                <div class="p-3 rounded-lg bg-surface-container-low border border-soft-gray text-xs space-y-1">
                                    <strong class="text-carbon-black font-bold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                                        1 Hari Aktif
                                    </strong>
                                    <p class="text-on-surface-variant">Tercatat saat Anda menonton video materi atau mengerjakan kuisioner evaluasi.</p>
                                </div>
                                <div class="p-3 rounded-lg bg-surface-container-low border border-soft-gray text-xs space-y-1">
                                    <strong class="text-carbon-black font-bold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-royal-purple text-sm">shield</span>
                                        Tanpa Penalti
                                    </strong>
                                    <p class="text-on-surface-variant">Hari libur atau absen tidak menggagalkan program; akumulasi hari sebelumnya tetap tersimpan.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Mini Calendar Visual Preview -->
                        <div class="w-full lg:w-96 p-5 rounded-xl bg-surface-container-low border border-soft-gray space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="font-label-caps text-xs font-bold text-carbon-black flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-royal-purple text-base">calendar_month</span>
                                    Simulasi 90 Hari Belajar
                                </span>
                                <span class="text-[10px] font-label-caps font-bold px-2 py-0.5 rounded bg-neon-mint text-carbon-black">Target 90</span>
                            </div>
                            
                            <!-- Grid Dots Preview (30 dots representation) -->
                            <div class="grid grid-cols-10 gap-1.5 pt-1">
                                @for($d = 1; $d <= 30; $d++)
                                    @php
                                        $isSimActive = in_array($d, [1, 2, 3, 5, 6, 8, 9, 10, 11, 12, 14, 15, 17, 18]);
                                        $isSimToday = $d == 19;
                                    @endphp
                                    <div class="aspect-square rounded flex items-center justify-center text-[10px] font-bold
                                        {{ $isSimActive ? 'bg-neon-mint text-carbon-black' : '' }}
                                        {{ $isSimToday ? 'ring-2 ring-royal-purple bg-primary-fixed text-royal-purple' : '' }}
                                        {{ !$isSimActive && !$isSimToday ? 'bg-surface-container text-outline/60' : '' }}
                                    ">
                                        {{ $d }}
                                    </div>
                                @endfor
                            </div>

                            <div class="pt-2 border-t border-soft-gray flex items-center justify-between text-[11px] text-on-surface-variant font-medium">
                                <span class="flex items-center gap-1">
                                    <span class="w-2.5 h-2.5 rounded bg-neon-mint inline-block"></span> Aktif
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="w-2.5 h-2.5 rounded ring-2 ring-royal-purple bg-primary-fixed inline-block"></span> Hari Ini
                                </span>
                                <span class="flex items-center gap-1">
                                    <span class="w-2.5 h-2.5 rounded bg-surface-container inline-block"></span> Belum
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ======================================================== -->
                <!-- 6. Call To Action (CTA Banner) -->
                <!-- ======================================================== -->
                <section class="rounded-2xl bg-gradient-to-r from-royal-purple to-primary-container p-8 sm:p-12 text-surface-card-white shadow-xl text-center space-y-6 relative overflow-hidden">
                    <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-neon-mint/20 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute -right-16 -top-16 w-64 h-64 bg-surface-card-white/10 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="relative z-10 max-w-2xl mx-auto space-y-3">
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-neon-mint text-carbon-black font-label-caps text-xs font-bold">
                            <span class="material-symbols-outlined text-xs">stars</span> NURSEPULSE ACADEMY
                        </span>
                        <h2 class="font-headline-lg text-2xl sm:text-3xl font-extrabold text-surface-card-white tracking-tight">
                            Siap Mengembangkan Kompetensi Klinis Anda?
                        </h2>
                        <p class="font-body-md text-sm text-surface-bright/90">
                            Akses modul pembelajaran mandiri, tonton video materi, kerjakan evaluasi, dan raih sertifikat kompetensi resmi 90 hari.
                        </p>
                    </div>

                    <div class="relative z-10 flex flex-wrap items-center justify-center gap-4 pt-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-lg bg-surface-card-white text-royal-purple font-label-md text-sm font-bold hover:bg-surface-container-lowest transition-colors shadow-lg">
                                Buka Dashboard Belajar
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-6 py-3 rounded-lg bg-neon-mint text-carbon-black font-label-md text-sm font-bold hover:bg-secondary-fixed transition-colors shadow-lg">
                                Daftar Akun Baru
                            </a>
                            <a href="{{ route('login') }}" class="px-6 py-3 rounded-lg bg-surface-card-white/15 hover:bg-surface-card-white/25 text-surface-card-white font-label-md text-sm font-bold transition-colors border border-surface-card-white/20">
                                Masuk Akun
                            </a>
                        @endauth
                    </div>
                </section>

            </div>
        </div>

        <!-- Footer (Exact Stitch Design with floating 3D SVG asterisk logo) -->
        <footer
            class="w-full bg-carbon-black text-surface-card-white rounded-t-[36px] sm:rounded-t-[48px] relative pt-12 pb-8 px-4 sm:px-8 lg:px-12 shadow-2xl mt-20">
            <div
                class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#53E6D4_1px,transparent_1px)] [background-size:24px_24px]">
            </div>
            <div class="max-w-[1440px] mx-auto relative z-10 flex flex-col items-center">
                <!-- Center Floating 3D Logo & Intro -->
                <div class="flex flex-col items-center text-center max-w-2xl mb-10 relative z-20">
                    <div class="-mt-24 sm:-mt-28 mb-4 relative flex items-center justify-center">
                        <div
                            class="w-28 h-28 sm:w-36 sm:h-36 relative transition-transform duration-300 hover:scale-105 cursor-pointer filter drop-shadow-[0_12px_24px_rgba(0,0,0,0.45)] drop-shadow-[0_0_20px_rgba(83,230,212,0.35)]">
                            <svg viewBox="0 0 200 200" class="w-full h-full">
                                <defs>
                                    <filter id="topo-depth" x="-20%" y="-20%" width="140%" height="140%">
                                        <feDropShadow dx="0" dy="6" stdDeviation="6" flood-color="#00201c"
                                            flood-opacity="0.6"></feDropShadow>
                                        <feDropShadow dx="0" dy="2" stdDeviation="2" flood-color="#000000"
                                            flood-opacity="0.4"></feDropShadow>
                                    </filter>
                                    <linearGradient id="asterisk-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#69f9e6"></stop>
                                        <stop offset="50%" stop-color="#53E6D4"></stop>
                                        <stop offset="100%" stop-color="#007167"></stop>
                                    </linearGradient>
                                    <clipPath id="asterisk-clip">
                                        <path id="asterisk-base"
                                            d="M 100,16 C 107,16 113,22 114,29 L 119,65 C 120,70 123,73 127,71 L 160,54 C 166,51 174,54 177,60 C 180,66 177,74 172,78 L 140,97 C 136,100 136,104 140,107 L 172,126 C 177,130 180,138 177,144 C 174,150 166,153 160,150 L 127,133 C 123,131 120,134 119,139 L 114,175 C 113,182 107,188 100,188 C 93,188 87,182 86,175 L 81,139 C 80,134 77,131 73,133 L 40,150 C 34,153 26,150 23,144 C 20,138 23,130 28,126 L 60,107 C 64,104 64,100 60,97 L 28,78 C 23,74 20,66 23,60 C 26,54 34,51 40,54 L 73,71 C 77,73 80,70 81,65 L 86,29 C 87,22 93,16 100,16 Z">
                                        </path>
                                    </clipPath>
                                </defs>
                                <g filter="url(#topo-depth)">
                                    <path
                                        d="M 100,16 C 107,16 113,22 114,29 L 119,65 C 120,70 123,73 127,71 L 160,54 C 166,51 174,54 177,60 C 180,66 177,74 172,78 L 140,97 C 136,100 136,104 140,107 L 172,126 C 177,130 180,138 177,144 C 174,150 166,153 160,150 L 127,133 C 123,131 120,134 119,139 L 114,175 C 113,182 107,188 100,188 C 93,188 87,182 86,175 L 81,139 C 80,134 77,131 73,133 L 40,150 C 34,153 26,150 23,144 C 20,138 23,130 28,126 L 60,107 C 64,104 64,100 60,97 L 28,78 C 23,74 20,66 23,60 C 26,54 34,51 40,54 L 73,71 C 77,73 80,70 81,65 L 86,29 C 87,22 93,16 100,16 Z"
                                        fill="url(#asterisk-grad)"></path>
                                    <path
                                        d="M 100,16 C 107,16 113,22 114,29 L 119,65 C 120,70 123,73 127,71 L 160,54 C 166,51 174,54 177,60 C 180,66 177,74 172,78 L 140,97 C 136,100 136,104 140,107 L 172,126 C 177,130 180,138 177,144 C 174,150 166,153 160,150 L 127,133 C 123,131 120,134 119,139 L 114,175 C 113,182 107,188 100,188 C 93,188 87,182 86,175 L 81,139 C 80,134 77,131 73,133 L 40,150 C 34,153 26,150 23,144 C 20,138 23,130 28,126 L 60,107 C 64,104 64,100 60,97 L 28,78 C 23,74 20,66 23,60 C 26,54 34,51 40,54 L 73,71 C 77,73 80,70 81,65 L 86,29 C 87,22 93,16 100,16 Z"
                                        fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.5"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <h2 class="font-headline-md text-2xl font-bold text-surface-card-white mb-2">
                        NursePulse Academy
                    </h2>
                    <p class="font-body-md text-sm text-surface-variant">
                        Platform Pembelajaran Mandiri &amp; Sertifikasi Keperawatan Klinis Berkelanjutan.
                    </p>
                </div>

                <!-- Bottom Copyright -->
                <div
                    class="w-full pt-6 border-t border-surface-card-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-outline font-body-sm">
                    <div>© {{ date('Y') }} NursePulse Academy. Seluruh Hak Cipta Dilindungi.</div>
                    <div class="flex items-center gap-6">
                        <a href="#modul-pembelajaran" class="hover:text-surface-card-white transition-colors">Modul</a>
                        <a href="#alur-belajar" class="hover:text-surface-card-white transition-colors">Alur 90 Hari</a>
                        <a href="{{ route('schedule.index') }}" class="hover:text-surface-card-white transition-colors">Jadwal</a>
                    </div>
                </div>
            </div>
        </footer>
    </main>

</body>

</html>