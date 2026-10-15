<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Dashboard') - NursePulse Academy</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&amp;family=Source+Sans+3:wght@400;600;700&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">

    <style>
        @layer base {

            html,
            body {
                margin: 0;
                padding: 0;
            }

            body {
                overscroll-behavior: none;
            }

            main> :first-child {
                margin-top: 0 !important;
            }

            main> :last-child {
                margin-bottom: 0 !important;
            }
        }

        ::-webkit-scrollbar {
            display: none;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>

    <!-- Tailwind CSS with EXACT Stitch Design System Configuration -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "soft-gray": "#EBEBED",
                        "on-tertiary-fixed": "#171c1f",
                        "on-error-container": "#93000a",
                        "surface-bright": "#f9f9fb",
                        "on-surface": "#1a1c1d",
                        "surface-container-high": "#e8e8ea",
                        "surface-container-low": "#f3f3f5",
                        "error": "#ba1a1a",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-container": "#007167",
                        "primary-container": "#6045f4",
                        "clinical-danger": "#E53935",
                        "surface-container": "#eeeef0",
                        "surface-dim": "#dadadc",
                        "tertiary-container": "#62676b",
                        "carbon-black": "#0F1417",
                        "secondary-container": "#69f9e6",
                        "inverse-primary": "#c7bfff",
                        "secondary-fixed-dim": "#46dcca",
                        "tertiary-fixed": "#dfe3e7",
                        "error-container": "#ffdad6",
                        "on-primary-fixed": "#170065",
                        "royal-purple": "#6045F4",
                        "outline": "#787587",
                        "on-tertiary-container": "#e1e6ea",
                        "on-primary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "tertiary-fixed-dim": "#c2c7cb",
                        "on-background": "#1a1c1d",
                        "ce-credit-gold": "#E5A93C",
                        "on-tertiary-fixed-variant": "#42474b",
                        "on-tertiary": "#ffffff",
                        "neon-mint": "#53E6D4",
                        "primary-fixed": "#e4dfff",
                        "tertiary": "#4a4f53",
                        "primary": "#4722dc",
                        "secondary-fixed": "#69f9e6",
                        "inverse-surface": "#2f3132",
                        "inverse-on-surface": "#f0f0f2",
                        "background": "#f9f9fb",
                        "on-surface-variant": "#474556",
                        "on-primary-container": "#e7e1ff",
                        "outline-variant": "#c8c4d9",
                        "surface-card-white": "#FFFFFF",
                        "surface-tint": "#583bec",
                        "surface": "#f9f9fb",
                        "secondary": "#006a60",
                        "surface-variant": "#e2e2e4",
                        "on-primary-fixed-variant": "#3f10d5",
                        "surface-container-highest": "#e2e2e4",
                        "primary-fixed-dim": "#c7bfff",
                        "on-secondary-fixed-variant": "#005048",
                        "on-error": "#ffffff",
                        "on-secondary-fixed": "#00201c"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "layout-max-width": "1440px",
                        "margin-tablet": "2rem",
                        "margin-mobile": "1rem",
                        "gutter-desktop": "2rem",
                        "space-lg": "1.5rem",
                        "space-2xl": "3rem",
                        "margin-desktop": "3rem",
                        "gutter-tablet": "1.5rem",
                        "space-md": "1rem",
                        "space-xl": "2rem",
                        "space-xs": "0.5rem",
                        "space-sm": "0.75rem",
                        "space-3xl": "4rem",
                        "space-2xs": "0.25rem",
                        "gutter-mobile": "1rem"
                    },
                    "fontFamily": {
                        "body-md": ['"Source Sans 3"', 'sans-serif'],
                        "headline-lg": ["Manrope", 'sans-serif'],
                        "headline-lg-mobile": ["Manrope", 'sans-serif'],
                        "body-lg": ['"Source Sans 3"', 'sans-serif'],
                        "metric-digit": ["Manrope", 'sans-serif'],
                        "headline-sm": ["Manrope", 'sans-serif'],
                        "title-md": ["Manrope", 'sans-serif'],
                        "headline-md": ["Manrope", 'sans-serif'],
                        "body-sm": ['"Source Sans 3"', 'sans-serif'],
                        "label-md": ["Manrope", 'sans-serif'],
                        "display-hero-mobile": ["Manrope", 'sans-serif'],
                        "display-hero": ["Manrope", 'sans-serif'],
                        "label-caps": ["Manrope", 'sans-serif']
                    },
                    "fontSize": {
                        "body-md": ["15px", { "lineHeight": "22px", "fontWeight": "400" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "headline-lg-mobile": ["26px", { "lineHeight": "34px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "metric-digit": ["28px", { "lineHeight": "32px", "fontWeight": "800" }],
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "title-md": ["16px", { "lineHeight": "24px", "fontWeight": "600" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "body-sm": ["13px", { "lineHeight": "18px", "fontWeight": "400" }],
                        "label-md": ["14px", { "lineHeight": "20px", "fontWeight": "600" }],
                        "display-hero-mobile": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.015em", "fontWeight": "800" }],
                        "display-hero": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                        "label-caps": ["11px", { "lineHeight": "16px", "letterSpacing": "0.08em", "fontWeight": "700" }]
                    }
                }
            }
        }
    </script>
    @yield('styles')
</head>

<body class="bg-background font-body-md text-body-md text-on-surface antialiased">
    <!-- Header / Top Navigation Bar (Stitch Design) -->
    <header
        class="fixed top-0 left-0 right-0 z-50 bg-surface-card-white/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(15,20,23,0.04)]">
        <div
            class="h-20 w-full px-4 sm:px-6 lg:px-gutter-desktop flex items-center justify-between gap-space-md max-w-[1440px] mx-auto">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center min-w-max">
                <img alt="NursePulse Academy Logo" class="h-16 w-auto object-contain"
                    src="{{ asset('logo/logo.png') }}">
            </a>

            <!-- Search Bar -->
            <div class="flex-1 max-w-xl mx-space-md hidden md:block">
                <div class="relative flex items-center w-full">
                    <span
                        class="material-symbols-outlined absolute left-space-sm text-outline pointer-events-none text-[20px]">search</span>
                    <input
                        class="w-full h-10 pl-10 pr-space-md rounded-lg bg-surface-container-low text-carbon-black placeholder:text-outline text-body-sm font-body-sm focus:outline-none focus:bg-surface-card-white shadow-[0_0_0_1px_rgba(15,20,23,0.08)] focus:shadow-[0_0_0_2px_#6045F4] transition-all"
                        placeholder="Cari modul akreditasi, farmakologi, materi klinis..." type="text">
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="hidden xl:flex items-center gap-space-lg">
                <a href="{{ route('dashboard') }}"
                    class="transition-colors {{ request()->routeIs('dashboard') ? 'text-royal-purple font-label-md font-bold' : 'text-on-surface-variant hover:text-on-surface font-label-md text-label-md' }}">My
                    Learning</a>
                <a href="{{ route('courses.index') }}"
                    class="transition-colors {{ request()->routeIs('courses.*') ? 'text-royal-purple font-label-md font-bold' : 'text-on-surface-variant hover:text-on-surface font-label-md text-label-md' }}">Explore
                    Courses</a>
                <a href="{{ route('schedule.index') }}"
                    class="transition-colors {{ request()->routeIs('schedule.*') ? 'text-royal-purple font-label-md font-bold' : 'text-on-surface-variant hover:text-on-surface font-label-md text-label-md' }}">Target
                    90 Hari</a>
                <a href="{{ route('profile.edit') }}"
                    class="transition-colors {{ request()->routeIs('profile.*') ? 'text-royal-purple font-label-md font-bold' : 'text-on-surface-variant hover:text-on-surface font-label-md text-label-md' }}">Profil
                    Saya</a>
                @if(auth()->check() && auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-clinical-danger hover:text-red-700 font-label-md text-label-md font-bold transition-colors">Admin
                        Panel</a>
                @endif
            </nav>

            <!-- Right Actions -->
            <div class="flex items-center gap-space-sm min-w-max">
                @auth
                    <!-- 90 Days / CEUs Badge -->
                    <a href="{{ route('schedule.index') }}"
                        class="hidden sm:flex items-center gap-space-xs bg-surface-container-low px-space-sm py-1.5 rounded-full shadow-[0_0_0_1px_rgba(15,20,23,0.06)] hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-ce-credit-gold text-[18px]"
                            style="font-variation-settings: 'FILL' 1;">verified</span>
                        <div class="flex flex-col">
                            <span
                                class="font-label-caps text-label-caps text-carbon-black font-bold leading-none">{{ $activeDays ?? auth()->user()->getActiveDaysCount() }}/90
                                Hari</span>
                            <span class="font-label-caps text-[10px] text-outline leading-tight">SIKLUS AKTIF</span>
                        </div>
                    </a>

                    <!-- Notifications -->
                    <button aria-label="Notifications"
                        class="relative p-2 rounded-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors">
                        <span class="material-symbols-outlined text-[22px]">notifications</span>
                        <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 rounded-full bg-clinical-danger"></span>
                    </button>

                    <!-- User Profile Dropdown -->
                    <div class="relative" id="userMenuContainer">
                        <button onclick="document.getElementById('userDropdown').classList.toggle('hidden')"
                            class="flex items-center gap-space-xs pl-space-xs focus:outline-none cursor-pointer">
                            <div
                                class="w-8 h-8 rounded-full bg-primary-fixed text-royal-purple font-bold flex items-center justify-center text-xs overflow-hidden border border-royal-purple/20">
                                @if(auth()->user()->profile?->photo)
                                    <img alt="Profile" class="w-full h-full object-cover"
                                        src="{{ asset('storage/' . auth()->user()->profile->photo) }}">
                                @else
                                    {{ strtoupper(substr(auth()->user()->profile->full_name ?? auth()->user()->name, 0, 2)) }}
                                @endif
                            </div>
                            <div class="hidden lg:flex flex-col text-left">
                                <span
                                    class="font-label-md text-label-md text-carbon-black leading-tight font-bold">{{ Str::limit(auth()->user()->profile->full_name ?? auth()->user()->name, 18) }}</span>
                                <span
                                    class="font-label-caps text-[10px] text-royal-purple font-semibold leading-tight uppercase">{{ auth()->user()->isAdmin() ? 'ADMINISTRATOR' : (auth()->user()->profile?->hospital ? Str::limit(auth()->user()->profile->hospital, 15) : 'PERAWAT KLINIS') }}</span>
                            </div>
                            <span
                                class="material-symbols-outlined text-outline text-[18px] hidden lg:block">expand_more</span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown"
                            class="hidden absolute right-0 mt-2 w-52 bg-surface-card-white rounded-xl shadow-xl border border-soft-gray py-2 z-50">
                            <div class="px-4 py-2 border-b border-soft-gray">
                                <p class="font-label-md text-xs font-bold text-carbon-black">
                                    {{ auth()->user()->profile->full_name ?? auth()->user()->name }}</p>
                                <p class="text-[11px] text-outline truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-carbon-black hover:bg-surface-container-low transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-royal-purple">dashboard</span> My
                                Learning
                            </a>
                            <a href="{{ route('courses.index') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-carbon-black hover:bg-surface-container-low transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-royal-purple">school</span> Explore
                                Courses
                            </a>
                            <a href="{{ route('schedule.index') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-carbon-black hover:bg-surface-container-low transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-royal-purple">calendar_month</span>
                                Target 90 Hari
                            </a>
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-carbon-black hover:bg-surface-container-low transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-royal-purple">person</span> Profil
                                Saya
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
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded-lg bg-royal-purple text-surface-card-white text-sm font-bold hover:bg-primary transition-colors">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 rounded-lg border border-royal-purple text-royal-purple text-sm font-bold hover:bg-royal-purple/5 transition-colors">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main App Canvas -->
    <main class="w-full pt-20 bg-background min-h-screen">
        <!-- Global Flash Alerts -->
        @if(session('success') || session('error'))
            <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                @if(session('success'))
                    <div
                        class="bg-surface-card-white border-l-4 border-neon-mint text-carbon-black p-4 rounded-xl shadow-sm flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-[22px]">check_circle</span>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div
                        class="bg-error-container border-l-4 border-clinical-danger text-on-error-container p-4 rounded-xl shadow-sm flex items-center gap-3">
                        <span class="material-symbols-outlined text-clinical-danger text-[22px]">error</span>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif
            </div>
        @endif

        <!-- Page Dynamic Content -->
        @yield('content')

        <!-- Footer (Exact Stitch Design with floating 3D logo & curved top) -->
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
                                    <linearGradient id="edge-bevel" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="#ffffff" stop-opacity="0.7"></stop>
                                        <stop offset="40%" stop-color="#ffffff" stop-opacity="0.1"></stop>
                                        <stop offset="100%" stop-color="#00332c" stop-opacity="0.6"></stop>
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
                                    <g clip-path="url(#asterisk-clip)">
                                        <path d="M 100,20 Q 102,60 100,100 Q 98,140 100,184" stroke="#062a24"
                                            stroke-width="2.6" stroke-linecap="round" fill="none"></path>
                                        <path d="M 94,22 Q 97,55 93,100 Q 89,145 93,180" stroke="#093d35"
                                            stroke-width="2.4" stroke-linecap="round" fill="none"></path>
                                        <path d="M 106,22 Q 103,55 107,100 Q 111,145 107,180" stroke="#093d35"
                                            stroke-width="2.4" stroke-linecap="round" fill="none"></path>
                                        <path d="M 88,26 Q 90,65 83,100 Q 78,135 86,174" stroke="#0b4d42"
                                            stroke-width="2.3" stroke-linecap="round" fill="none"></path>
                                        <path d="M 112,26 Q 110,65 117,100 Q 122,135 114,174" stroke="#0b4d42"
                                            stroke-width="2.3" stroke-linecap="round" fill="none"></path>
                                        <path d="M 32,64 Q 65,72 100,100 Q 135,128 168,136" stroke="#062a24"
                                            stroke-width="2.6" stroke-linecap="round" fill="none"></path>
                                        <path d="M 36,58 Q 68,66 96,96 Q 132,122 164,130" stroke="#093d35"
                                            stroke-width="2.4" stroke-linecap="round" fill="none"></path>
                                        <path d="M 40,70 Q 72,78 104,104 Q 138,134 172,142" stroke="#093d35"
                                            stroke-width="2.4" stroke-linecap="round" fill="none"></path>
                                        <path d="M 32,136 Q 65,128 100,100 Q 135,72 168,64" stroke="#062a24"
                                            stroke-width="2.6" stroke-linecap="round" fill="none"></path>
                                        <path d="M 36,142 Q 68,134 96,104 Q 132,78 164,70" stroke="#093d35"
                                            stroke-width="2.4" stroke-linecap="round" fill="none"></path>
                                        <path d="M 40,130 Q 72,122 104,96 Q 138,66 172,58" stroke="#093d35"
                                            stroke-width="2.4" stroke-linecap="round" fill="none"></path>
                                        <ellipse cx="100" cy="100" rx="16" ry="14" stroke="#05231e" stroke-width="2.6"
                                            fill="none"></ellipse>
                                        <ellipse cx="100" cy="100" rx="28" ry="24" stroke="#093d35" stroke-width="2.3"
                                            fill="none"></ellipse>
                                        <ellipse cx="100" cy="100" rx="44" ry="38" stroke="#0c4e43" stroke-width="2.2"
                                            fill="none"></ellipse>
                                    </g>
                                    <path
                                        d="M 100,16 C 107,16 113,22 114,29 L 119,65 C 120,70 123,73 127,71 L 160,54 C 166,51 174,54 177,60 C 180,66 177,74 172,78 L 140,97 C 136,100 136,104 140,107 L 172,126 C 177,130 180,138 177,144 C 174,150 166,153 160,150 L 127,133 C 123,131 120,134 119,139 L 114,175 C 113,182 107,188 100,188 C 93,188 87,182 86,175 L 81,139 C 80,134 77,131 73,133 L 40,150 C 34,153 26,150 23,144 C 20,138 23,130 28,126 L 60,107 C 64,104 64,100 60,97 L 28,78 C 23,74 20,66 23,60 C 26,54 34,51 40,54 L 73,71 C 77,73 80,70 81,65 L 86,29 C 87,22 93,16 100,16 Z"
                                        fill="none" stroke="rgba(255,255,255,0.4)" stroke-width="1.5"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <h2
                            class="font-headline-lg text-2xl sm:text-[34px] font-extrabold text-surface-card-white tracking-tight leading-tight">
                            NursePulse Academy</h2>
                        <p class="font-body-md text-sm sm:text-base text-outline-variant font-medium">Membangun Standar
                            Kompetensi &amp; Karir Keperawatan Indonesia</p>
                    </div>
                    <div class="flex flex-wrap items-center justify-center gap-3 pt-4">
                        <a class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-neon-mint hover:bg-secondary-fixed text-carbon-black font-label-md text-sm font-bold shadow-md shadow-neon-mint/20 transition-all duration-200"
                            href="{{ route('courses.index') }}">
                            <span>Mulai Belajar Sekarang</span>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                        <a class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full border border-neon-mint/40 text-neon-mint hover:bg-neon-mint/10 font-label-md text-sm font-semibold transition-all duration-200"
                            href="{{ route('schedule.index') }}">
                            <span>Jadwal 90 Hari Belajar</span>
                            <span class="material-symbols-outlined text-base">calendar_month</span>
                        </a>
                    </div>
                </div>

                <!-- Footer Columns Grid -->
                <div
                    class="w-full grid grid-cols-1 md:grid-cols-12 gap-8 sm:gap-10 pb-10 border-b border-surface-card-white/10">
                    <div class="md:col-span-5 space-y-4">
                        <h3
                            class="font-title-md text-base font-bold text-surface-card-white tracking-wide uppercase text-[13px]">
                            Kontak &amp; Layanan</h3>
                        <p class="font-body-sm text-sm text-outline-variant leading-relaxed">Gedung Pusat Edukasi
                            Kesehatan Mandiri, Jl. Salemba Raya No. 42, Jakarta Pusat 10430</p>
                        <div class="space-y-1.5 font-body-sm text-sm text-surface-variant">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-neon-mint">call</span>
                                <span>+62 21 3983 5500</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-neon-mint">mail</span>
                                <span>akademik@nursepulse.id</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-x-4 gap-y-2 pt-1 font-label-md text-xs text-outline-variant">
                            <a href="#"
                                class="hover:text-neon-mint transition-colors flex items-center gap-0.5">Instagram <span
                                    class="material-symbols-outlined text-[12px]">north_east</span></a>
                            <a href="#"
                                class="hover:text-neon-mint transition-colors flex items-center gap-0.5">LinkedIn <span
                                    class="material-symbols-outlined text-[12px]">north_east</span></a>
                            <a href="#" class="hover:text-neon-mint transition-colors flex items-center gap-0.5">YouTube
                                <span class="material-symbols-outlined text-[12px]">north_east</span></a>
                            <a href="#"
                                class="hover:text-neon-mint transition-colors flex items-center gap-0.5">Komunitas
                                Telegram <span class="material-symbols-outlined text-[12px]">north_east</span></a>
                        </div>
                        <div class="pt-2">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-surface-card-white/5 border border-surface-card-white/10">
                                <span class="material-symbols-outlined text-ce-credit-gold text-base">verified</span>
                                <span class="font-label-caps text-xs text-surface-card-white font-semibold">4.9
                                    Terakreditasi Kemenkes RI &amp; PPNI</span>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-7 space-y-4">
                        <h3
                            class="font-title-md text-base font-bold text-surface-card-white tracking-wide uppercase text-[13px]">
                            Navigasi Cepat</h3>
                        <div
                            class="grid grid-cols-2 sm:grid-cols-2 gap-x-6 gap-y-3 font-body-sm text-sm text-outline-variant">
                            <a href="{{ route('courses.index') }}"
                                class="hover:text-surface-card-white transition-colors">Kurikulum Modul Course</a>
                            <a href="{{ route('schedule.index') }}"
                                class="hover:text-surface-card-white transition-colors">Kalender 90 Hari Belajar</a>
                            <a href="{{ route('dashboard') }}"
                                class="hover:text-surface-card-white transition-colors">Capaian &amp; Evaluasi SKP</a>
                            <a href="{{ route('profile.edit') }}"
                                class="hover:text-surface-card-white transition-colors">Verifikasi Profil Perawat</a>
                            <a href="#" class="hover:text-surface-card-white transition-colors">Bank Kasus Klinis</a>
                            <a href="#" class="hover:text-surface-card-white transition-colors">Pusat Bantuan &amp;
                                FAQ</a>
                            <a href="#" class="hover:text-surface-card-white transition-colors">Kerjasama Rumah
                                Sakit</a>
                            <a href="#" class="hover:text-surface-card-white transition-colors">Simulasi UKOM
                                Perawat</a>
                        </div>
                    </div>
                </div>

                <!-- Bottom Copyright Bar -->
                <div
                    class="w-full pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-outline font-body-sm">
                    <div>© {{ date('Y') }} NursePulse Academy. Hak Cipta Dilindungi.</div>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="#"
                            class="hover:text-surface-card-white transition-colors px-2.5 py-1 rounded bg-surface-card-white/5 hover:bg-surface-card-white/10">Kebijakan
                            Privasi</a>
                        <a href="#"
                            class="hover:text-surface-card-white transition-colors px-2.5 py-1 rounded bg-surface-card-white/5 hover:bg-surface-card-white/10">Syarat
                            &amp; Ketentuan</a>
                        <a href="#"
                            class="hover:text-surface-card-white transition-colors px-2.5 py-1 rounded bg-surface-card-white/5 hover:bg-surface-card-white/10">Standar
                            Akreditasi Kemenkes</a>
                        <a href="#"
                            class="hover:text-surface-card-white transition-colors px-2.5 py-1 rounded bg-surface-card-white/5 hover:bg-surface-card-white/10">Verifikasi
                            Sertifikat</a>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- Close dropdown when clicking outside -->
    <script>
        window.addEventListener('click', function (e) {
            const container = document.getElementById('userMenuContainer');
            const dropdown = document.getElementById('userDropdown');
            if (container && dropdown && !container.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    @yield('scripts')
</body>

</html>