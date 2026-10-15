<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin: @yield('title', 'Dashboard') - NursePulse Academy</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "primary": "#834DFB",
                    "on-primary": "#ffffff",
                    "primary-container": "#ECE4FD",
                    "on-primary-container": "#310B78",
                    "primary-fixed": "#EDE5FE",
                    "primary-fixed-dim": "#D2BEFC",
                    "on-primary-fixed": "#18102B",
                    "on-primary-fixed-variant": "#5826BC",
                    "inverse-primary": "#C4ABFC",

                    "secondary": "#F0E100",
                    "on-secondary": "#18102B",
                    "secondary-container": "#FEFCE8",
                    "on-secondary-container": "#18102B",
                    "secondary-fixed": "#F0E100",
                    "secondary-fixed-dim": "#E6D700",
                    "on-secondary-fixed": "#18102B",
                    "on-secondary-fixed-variant": "#18102B",

                    "tertiary": "#D97706",
                    "on-tertiary": "#ffffff",
                    "tertiary-container": "#FEF9C3",
                    "on-tertiary-container": "#713F12",
                    "tertiary-fixed": "#FEF08A",
                    "tertiary-fixed-dim": "#FDE047",
                    "on-tertiary-fixed": "#18102B",
                    "on-tertiary-fixed-variant": "#713F12",

                    "background": "#F5F3FF",
                    "on-background": "#18102B",

                    "surface": "#F5F3FF",
                    "on-surface": "#18102B",
                    "surface-variant": "#ECE7FD",
                    "on-surface-variant": "#585175",
                    "surface-dim": "#DCD5F7",
                    "surface-bright": "#FAFAFF",
                    "surface-container-lowest": "#ffffff",
                    "surface-container-low": "#F5F3FF",
                    "surface-container": "#EAE5FA",
                    "surface-container-high": "#E0DAF7",
                    "surface-container-highest": "#D5CEF4",
                    "surface-tint": "#834DFB",

                    "outline": "#7D759B",
                    "outline-variant": "#DDD7F3",

                    "inverse-surface": "#18102B",
                    "inverse-on-surface": "#F5F3FF",

                    "error": "#BA1A1A",
                    "on-error": "#ffffff",
                    "error-container": "#FFDAD6",
                    "on-error-container": "#93000A",

                    "electric-violet": "#834DFB",
                    "turbo": "#F0E100",
                    "haiti": "#18102B",
                    "blue-chalk": "#F5F3FF"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "sm": "12px",
                    "lg": "48px",
                    "gutter": "24px",
                    "margin-mobile": "16px",
                    "xs": "4px",
                    "margin-desktop": "48px",
                    "md": "24px",
                    "xl": "80px",
                    "base": "8px"
            },
            "fontFamily": {
                    "sans": ["'Source Sans 3'", "sans-serif"],
                    "display": ["Manrope", "sans-serif"],
                    "headline-lg": ["Manrope", "sans-serif"],
                    "headline-md": ["Manrope", "sans-serif"],
                    "body-md": ["'Source Sans 3'", "sans-serif"],
                    "body-lg": ["'Source Sans 3'", "sans-serif"],
                    "label-md": ["'Source Sans 3'", "sans-serif"],
                    "caption": ["'Source Sans 3'", "sans-serif"]
            },
            "fontSize": {
                    "headline-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "600"}],
                    "headline-md": ["20px", {"lineHeight": "1.4", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "1.6", "letterSpacing": "0.01em", "fontWeight": "400"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "letterSpacing": "0.01em", "fontWeight": "400"}],
                    "label-md": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.03em", "fontWeight": "500"}],
                    "caption": ["12px", {"lineHeight": "1.4", "letterSpacing": "0.02em", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
    <style>
        body {
            background-color: #F5F3FF;
            color: #18102B;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        .clinical-shadow {
            box-shadow: 0px 4px 16px rgba(24, 16, 43, 0.05);
        }
        .sidebar-item-active {
            background-color: #834DFB;
            color: #ffffff;
        }
        .sidebar-item-inactive {
            color: #585175;
        }
        .sidebar-item-inactive:hover {
            background-color: #ECE4FD;
            color: #834DFB;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .stat-card-glow {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0px 8px 24px rgba(131, 77, 251, 0.14);
        }
    </style>
    @yield('styles')
</head>
<body class="flex min-h-screen">
<!-- Sidebar Navigation -->
<aside class="w-64 bg-surface-container-lowest border-r border-outline-variant flex flex-col fixed h-full z-20">
    <div class="px-6 h-16 flex items-center border-b border-outline-variant">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
            <img alt="NursePulse Academy Logo" class="h-10 w-auto object-contain" src="{{ asset('logo/logo.png') }}">
        </a>
    </div>
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-item-active' : 'sidebar-item-inactive' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200" href="{{ route('admin.dashboard') }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-label-md text-label-md">Overview</span>
        </a>
        <a class="{{ request()->routeIs('admin.users.*') ? 'sidebar-item-active' : 'sidebar-item-inactive' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200" href="{{ route('admin.users.index') }}">
            <span class="material-symbols-outlined">group</span>
            <span class="font-label-md text-label-md">Kelola Perawat</span>
        </a>
        <a class="{{ request()->routeIs('admin.courses.*') ? 'sidebar-item-active' : 'sidebar-item-inactive' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200" href="{{ route('admin.courses.index') }}">
            <span class="material-symbols-outlined">school</span>
            <span class="font-label-md text-label-md">Kelola Modul Course</span>
        </a>
    </nav>
    <div class="p-4 border-t border-outline-variant">
        <div class="bg-surface-container-low rounded-xl p-4">
            <p class="font-caption text-caption text-on-surface-variant">Status Sistem</p>
            <div class="flex items-center gap-2 mt-2">
                <div class="w-2 h-2 rounded-full bg-secondary"></div>
                <span class="font-label-md text-label-md text-on-surface">Sistem Berjalan Normal</span>
            </div>
        </div>
    </div>
</aside>

<!-- Main Canvas -->
<main class="flex-1 ml-64 flex flex-col min-h-screen">
    <!-- Top Bar -->
    <header class="h-16 bg-surface-container-lowest border-b border-outline-variant flex items-center justify-between px-margin-desktop sticky top-0 z-10">
        <div class="relative w-96">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
            <input class="w-full pl-10 pr-4 py-2 bg-surface-container-low border border-outline-variant rounded-full text-body-md focus:ring-2 focus:ring-primary focus:outline-none transition-all" placeholder="Cari perawat, modul, atau email..." type="text"/>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3 pl-2">
                <div class="text-right">
                    <p class="font-label-md text-label-md text-primary font-bold">Admin NursePulse</p>
                    <p class="font-caption text-caption text-on-surface-variant">{{ auth()->user()->email ?? 'admin@nursepulse.ac.id' }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold text-label-md">
                    AD
                </div>
            </div>
            <div class="h-8 w-px bg-outline-variant"></div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-1 text-error hover:bg-error-container p-2 rounded-lg transition-colors" title="Keluar">
                    <span class="material-symbols-outlined">logout</span>
                </button>
            </form>
        </div>
    </header>

    <!-- Page Content -->
    <div class="p-margin-desktop space-y-lg max-w-7xl mx-auto w-full flex-1">
        @if(session('success'))
            <div class="bg-surface-container-high border-l-4 border-primary text-on-surface p-4 rounded-lg flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined text-primary">check_circle</span>
                <span class="font-body-md text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-error-container border-l-4 border-error text-on-error-container p-4 rounded-lg flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined text-error">error</span>
                <span class="font-body-md text-sm">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="mt-auto py-8 px-margin-desktop border-t border-outline-variant bg-surface-container-lowest">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="font-body-sm text-caption text-on-surface-variant">
                © {{ date('Y') }} NursePulse Academy. Professional clinical education for healthcare excellence.
            </p>
            <div class="flex gap-6">
                <a class="font-caption text-caption text-on-surface-variant hover:text-primary transition-colors" href="#">Pusat Bantuan</a>
                <a class="font-caption text-caption text-on-surface-variant hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
                <a class="font-caption text-caption text-on-surface-variant hover:text-primary transition-colors" href="#">Syarat &amp; Ketentuan</a>
            </div>
        </div>
    </footer>
</main>

<!-- Micro-interactions Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Animate progress bars on load
        const progressBars = document.querySelectorAll('.bg-primary, .bg-secondary, .bg-on-secondary-container');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            if(width) {
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.transition = 'width 1s ease-out';
                    bar.style.width = width;
                }, 200);
            }
        });

        // Smooth reveal for stats
        const cards = document.querySelectorAll('.stat-card-glow');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@yield('scripts')
</body>
</html>
