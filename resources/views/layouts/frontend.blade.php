<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Masa Kini</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Lightbox CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Tambahkan FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />

    <script>
        // Check for dark mode preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#14b8a6',
                        secondary: '#0d9488',
                        'primary-light': '#99f6e4',
                        'primary-dark': '#0f766e',
                        dark: {
                            bg: '#134e4a',
                            card: '#115e59',
                            text: '#ccfbf1'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #14b8a6;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #0d9488;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .custom-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: thin;     /* Firefox */
        }

        /* Form focus ring color */
        .focus\:ring-primary:focus {
            --tw-ring-color: #14b8a6;
            --tw-ring-opacity: 0.5;
        }

        /* Button hover states */
        .hover\:bg-primary:hover {
            background-color: #14b8a6;
        }

        .hover\:bg-secondary:hover {
            background-color: #0d9488;
        }

        /* Text hover states */
        .hover\:text-primary:hover {
            color: #14b8a6;
        }

        /* Border colors */
        .border-primary {
            border-color: #14b8a6;
        }

        /* Background colors */
        .bg-primary {
            background-color: #14b8a6;
        }

        .bg-secondary {
            background-color: #0d9488;
        }

        /* Hover Animations */
        .hover-transition {
            transition: all 0.3s ease-in-out;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .hover-lift:hover {
            transform: translateY(-2px);
        }

        .hover-shadow:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* Loading Animations */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite linear;
        }

        /* Smooth Transitions */
        .page-transition {
            transition: opacity 0.3s ease-in-out;
        }

        /* Modern Card Styles */
        .modern-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
        }
    </style>
</head>
<body class="font-sans antialiased bg-primary-light/10">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-primary-dark/95 to-secondary/95 backdrop-blur-md">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo/Brand -->
                <a href="/" class="flex items-center space-x-3">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5gOfSB6ZM26FPjb_b7jvzcS8K6oJA03u0gg&s" 
                         alt="SMKN 4 Bogor" 
                         class="h-10 w-10">
                    <span class="text-xl font-bold text-white">SMKN 4 BOGOR</span>
                </a>
                
                <!-- Navigation Links & Search -->
                <div class="hidden md:flex items-center flex-1 justify-center px-16">
                    <!-- Search Form -->
                    <form action="{{ route('search') }}" method="GET" class="w-96">
                        <div class="relative">
                            <input type="text" 
                                   name="keyword" 
                                   placeholder="Cari informasi atau agenda..." 
                                   value="{{ request('keyword') }}"
                                   class="w-full bg-primary-dark/50 text-white placeholder-primary-light/70 rounded-lg pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-primary-light">
                            <button type="submit" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Navigation Links & Login -->
                <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}" class="text-white hover:text-primary transition">Beranda</a>
                    <!-- Link to Gallery -->
            <a href="/gallery" class="text-white hover:text-primary transition">Gallery</a>
                    <a href="/informasi" class="text-white hover:text-primary transition">Informasi</a>
                    <a href="/agenda" class="text-white hover:text-primary transition">Agenda</a>
                    <a href="#maps" class="text-white hover:text-primary transition">Kontak</a>
                    
                    <!-- Login Icon -->
                    <a href="{{ auth()->check() ? url('/admin/dashboard') : route('login') }}" 
                       class="text-white hover:text-primary transition">
                        <svg class="w-6 h-6" 
                             xmlns="http://www.w3.org/2000/svg" 
                             fill="none" 
                             viewBox="0 0 24 24" 
                             stroke-width="1.5" 
                             stroke="currentColor">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </a>
                </div>

                <!-- Mobile Menu -->
                <div class="md:hidden flex items-center space-x-4">
                    <!-- Mobile Search Button -->
                    <button type="button" 
                            class="text-white"
                            onclick="toggleMobileSearch()">
                        <i class="fas fa-search"></i>
                    </button>

                    <!-- Login Icon for Mobile -->
                    <a href="{{ auth()->check() ? url('/admin/dashboard') : route('login') }}" 
                       class="text-white">
                        <svg class="w-6 h-6" 
                             xmlns="http://www.w3.org/2000/svg" 
                             fill="none" 
                             viewBox="0 0 24 24" 
                             stroke-width="1.5" 
                             stroke="currentColor">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </a>

                    <!-- Mobile Menu Button -->
                    <button class="text-white" x-data @click="$dispatch('toggle-menu')">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Search Form (Hidden by default) -->
            <div id="mobileSearch" class="md:hidden hidden pb-4">
                <form action="{{ route('search') }}" method="GET">
                    <div class="relative">
                        <input type="text" 
                               name="keyword" 
                               placeholder="Cari informasi atau agenda..." 
                               value="{{ request('keyword') }}"
                               class="w-full bg-primary-dark/50 text-white placeholder-primary-light/70 rounded-lg pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-primary-light">
                        <button type="submit" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="md:hidden" x-data="{ open: false }" @toggle-menu.window="open = !open" x-cloak>
        <div x-show="open" class="fixed inset-0 z-40 bg-black bg-opacity-50" @click="open = false"></div>
        <div x-show="open" 
             class="fixed top-0 right-0 z-50 w-64 h-full bg-gradient-to-b from-primary to-primary-dark shadow-lg transform transition-transform duration-300">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-bold text-gray-800">Menu</h2>
                    <button @click="open = false" class="text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="flex flex-col space-y-4">
                <a href="#tentangkami" @click="open = false" class="text-gray-600 hover:text-primary transition">Tentang Kami</a>
                    <a href="#gallery" @click="open = false" class="text-gray-600 hover:text-primary transition">Gallery</a>
                    <a href="#informasi-agenda" @click="open = false" class="text-gray-600 hover:text-primary transition">Informasi & Agenda</a>
                    <a href="#maps" @click="open = false" class="text-gray-600 hover:text-primary transition">Kontak</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-b from-primary-dark to-[#134e4a] text-primary-light/90">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <!-- Website Link -->
                <div class="text-center md:text-left">
                    <a href="https://smkn4bogor.sch.id" 
                       target="_blank"
                       class="text-white hover:text-primary transition-colors duration-300">
                        <span class="font-semibold text-lg">SMKN 4 Bogor</span>
                    </a>
                    <p class="text-sm mt-1">Jl. Raya Tajur, Kp. Buntar, Muarasari</p>
                </div>
                <div class="col-md-4 text-center text-md-start mb-md-0">
                    <span class="text-body"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Gamaki - Gallery Masa Kini</a> All right reserved.</span>
                </div>

                <!-- Social Media -->
                <div class="flex items-center space-x-4">
                    <a href="https://facebook.com/smkn4bogor" 
                       target="_blank"
                       class="hover:text-primary transition-colors duration-300">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="https://instagram.com/smkn4bogor" 
                       target="_blank"
                       class="hover:text-primary transition-colors duration-300">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="https://youtube.com/smkn4bogor" 
                       target="_blank"
                       class="hover:text-primary transition-colors duration-300">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>

                <!-- Contact -->
                <div class="text-center md:text-right">
                    <div class="flex items-center justify-center md:justify-end space-x-2">
                        <i class="fas fa-phone"></i>
                        <span>(0251) 8242411</span>
                    </div>
                    <div class="flex items-center justify-center md:justify-end space-x-2 mt-1">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info@smkn4bogor.sch.id" 
                           class="hover:text-primary transition-colors duration-300">
                            info@smkn4bogor.sch.id
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @yield('scripts')
    @stack('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    
    <script>
    function toggleMobileSearch() {
        var searchForm = document.getElementById('mobileSearch');
        searchForm.classList.toggle('hidden');
    }
    </script>
</body>
</html>