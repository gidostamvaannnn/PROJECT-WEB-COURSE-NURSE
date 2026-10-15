<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auth') - NursePulse Academy</title>
    
    <!-- Tailwind CSS with Landing Page config -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
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
                    "fontFamily": {
                        "sans": ["'Source Sans 3'", "sans-serif"],
                        "display": ["Manrope", "sans-serif"],
                        "headline-md": ["Manrope", "sans-serif"],
                        "body-md": ["'Source Sans 3'", "sans-serif"],
                        "label-md": ["'Source Sans 3'", "sans-serif"],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .auth-pattern {
            background-image: radial-gradient(circle at 100% 0%, rgba(131, 77, 251, 0.18) 0%, transparent 50%),
                              radial-gradient(circle at 0% 100%, rgba(240, 225, 0, 0.12) 0%, transparent 50%),
                              radial-gradient(circle at 50% 50%, rgba(24, 16, 43, 0.04) 0%, transparent 70%);
        }
    </style>
</head>
<body class="font-body-md text-on-surface overflow-x-hidden min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative bg-[#18102B]">
    <!-- Background Image with Purple Overlay -->
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <img src="{{ asset('background/background login dan daftar.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <!-- Purple Tint & Overlay -->
        <div class="absolute inset-0 bg-[#3b1975]/80 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#140b24]/90 via-[#6045F4]/40 to-[#18102B]/80"></div>
    </div>

    <div class="max-w-md w-full space-y-8 bg-surface-container-lowest/95 backdrop-blur-xl p-8 rounded-3xl shadow-2xl shadow-black/40 border border-white/30 relative z-10">
        <div class="text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center mb-3">
                <img src="{{ asset('logo/logo.png') }}" alt="NursePulse Academy Logo" class="h-16 w-auto object-contain">
            </a>
            <p class="text-sm text-on-surface-variant font-medium">Platform Pelatihan &amp; Sertifikasi Perawat Klinis</p>
        </div>
        
        @if(session('success'))
            <div class="bg-surface-container-high border-l-4 border-primary text-on-surface p-4 rounded-md flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">check_circle</span>
                <span class="text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-error-container border-l-4 border-error text-on-error-container p-4 rounded-md flex items-center gap-3">
                <span class="material-symbols-outlined text-error">error</span>
                <span class="text-sm">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
