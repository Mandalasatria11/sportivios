<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SPORTIVIOS - Engineered for greatness. Discover professional-grade athletic footwear, apparel, and accessories.">
    <title>{{ $title ?? 'SPORTIVIOS - Engineered For Greatness' }}</title>

    <!-- Google Fonts: Inter, Montserrat, Barlow Condensed -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,600;0,700;0,800;0,900;1,700;1,800;1,900&family=Inter:wght@300;400;500;600;700&family=Montserrat:ital,wght@0,600;0,700;0,800;0,900;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Vite with CDN fallback) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            display: ['Montserrat', 'sans-serif'],
                            sport: ['"Barlow Condensed"', 'Montserrat', 'sans-serif'],
                        },
                        colors: {
                            cyan: {
                                'glow': '#8ee0ec',
                                'bright': '#67e8f9',
                                'deep': '#0891b2'
                            }
                        }
                    }
                }
            }
        </script>
    @endif

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #111827;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .font-sport {
            font-family: 'Barlow Condensed', 'Montserrat', sans-serif;
        }
        .font-display {
            font-family: 'Montserrat', sans-serif;
        }
        /* Blue textured zigzag / dotted bar underneath header */
        .header-blue-texture {
            height: 4px;
            width: 100%;
            background: repeating-linear-gradient(
                90deg,
                #2563eb 0px,
                #2563eb 6px,
                #3b82f6 6px,
                #3b82f6 10px,
                #1d4ed8 10px,
                #1d4ed8 14px
            );
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-white text-gray-900 antialiased selection:bg-cyan-200 selection:text-cyan-900">
    <!-- Navbar -->
    <x-navbar />

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-footer />
</body>
</html>
