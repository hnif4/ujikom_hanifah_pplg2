<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Masa Kini</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Lightbox CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    
    

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #fff;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 top-0">
        <div class="glass-effect border-b border-primary-200/20">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <a href="/" class="flex items-center space-x-3">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5gOfSB6ZM26FPjb_b7jvzcS8K6oJA03u0gg&s"
                            alt="SMKN 4 Bogor"
                            class="h-10 w-10 rounded-lg">
                        <span class="text-xl font-bold text-primary-700">GAMAKI SMKN 4 BOGOR</span>
                    </a>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-6">
                        <a href="/" class="nav-link text-primary-700 hover:text-primary-800 font-medium transition duration-300">Beranda</a>
                        <a href="/gallery" class="nav-link text-primary-700 hover:text-primary-800 font-medium transition duration-300">Galeri</a>

                        <!-- Dropdown Posts -->
                        <div class="relative group">
                            <button class="nav-link text-primary-700 hover:text-primary-800 font-medium transition duration-300 flex items-center py-2">
                                Postingan
                                <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                            </button>
                            <div class="absolute left-0 top-full pt-2">
                                <div class="w-48 bg-white rounded-lg shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2">
                                    <a href="/informasi" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition duration-300">
                                        <i class="fas fa-newspaper mr-2"></i>Informasi
                                    </a>
                                    <a href="/agenda" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-700 transition duration-300">
                                        <i class="fas fa-calendar-alt mr-2"></i>Agenda
                                    </a>
                                </div>
                            </div>
                        </div>

                        <a href="#maps" class="nav-link text-primary-700 hover:text-primary-800 font-medium transition duration-300">Kontak</a>

                        <!-- Search Button -->
                        <button type="button"
                            onclick="toggleSearch()"
                            class="p-2 rounded-full hover:bg-primary-100 text-primary-700 transition duration-300">
                            <i class="fas fa-search"></i>
                        </button>

                        <!-- Login Button -->
                        <a href="{{ auth()->check() ? url('/admin/dashboard') : route('login') }}"
                            class="px-4 py-2 rounded-lg bg-primary-600 text-white hover:bg-primary-700 transition duration-300 shadow-sm">
                            {{ auth()->check() ? 'Dashboard' : 'Login' }}
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-primary-700" @click="$dispatch('toggle-menu')">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Search Panel (Hidden by default) -->
        <div id="searchPanel" class="hidden glass-effect">
            <div class="container mx-auto px-4 py-4">
                <form action="{{ route('search') }}" method="GET">
                    <div class="relative">
                        <input type="text"
                            name="keyword"
                            placeholder="Cari informasi atau agenda..."
                            class="w-full px-4 py-2 rounded-lg bg-white/80 border border-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <button type="submit"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-primary-600">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-primary-100 mt-auto">
        <div class="container mx-auto px-4 py-8">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- About -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-primary-800">SMKN 4 Bogor</h3>
                    <p class="text-gray-600">KR4BAT (Kejuruan Empat Hebat)
                        Akhlak terpuji, Ilmu terkaji, Terampil dan Teruji.</p>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-primary-800">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-600 hover:text-primary-600">Beranda</a></li>
                        <li><a href="/gallery" class="text-gray-600 hover:text-primary-600">Galeri</a></li>
                        <li><a href="/informasi" class="text-gray-600 hover:text-primary-600">Informasi</a></li>
                        <li><a href="/agenda" class="text-gray-600 hover:text-primary-600">Agenda</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-primary-800">Kontak Kami</h3>
                    <ul class="space-y-2">
                        <div class="flex space-x-4">
                            <a href="https://api.whatsapp.com/send/?phone=6282260168886" target="_blank" class="text-primary-600 hover:text-primary-700">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://web.facebook.com/profile.php?id=100054636630766" class="text-primary-600 hover:text-primary-700">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/smkn4kotabogor/" class="text-primary-600 hover:text-primary-700">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://www.youtube.com/channel/UC4M-6Oc1ZvECz00MlMa4v_A/videos?app=desktop" class="text-primary-600 hover:text-primary-700">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="mailto:smkn4@smkn4bogor.sch.id" class="text-primary-600 hover:text-primary-700">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </ul>
                </div>

                <!-- Copyright -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-primary-800">Galeri Masa Kini</h3>
                    <p class="text-gray-600">© Ujikom 2024 - Siti Nur Hanifah - 12 PPLG 2. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function toggleSearch() {
            const searchPanel = document.getElementById('searchPanel');
            searchPanel.classList.toggle('hidden');
        }
    </script>
    @stack('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

</body>

</html>