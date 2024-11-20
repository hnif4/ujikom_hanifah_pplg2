<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/jpg"
        href="https://i.imgur.com/UyXqJLi.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;50
0;600;700&display=swap" rel="stylesheet">
    <!-- js -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.
js" defer></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

</head>

<body>
    <!-- Tambahkan elemen HTML yang menyimpan pesan session -->
    <div id="alert-data"
        data-success-message="{{ session('success') }}"
        data-error-message="{{ session('error') }}">
    </div>

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg gray-200 font-roboto">
        <div :class="sidebarOpen ? 'block' : 'hidden'"
            @click="sidebarOpen = false"
            class="fixed z-20 inset-0 bg-black opacity-50 transitionopacity lg:hidden"></div>
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-
translate-x-full ease-in'"
            class="fixed z-30 inset-y-0 left-0 w-64 transition
duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0
lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-4">
                <div class="flex items-center">
                    <svg class="h-12 w-12" viewBox="0 0 512 512"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M364.61 390.213C304.625 450.196 207.37
450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398
281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4
153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128
334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597
281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                            fill="#4C51BF" stroke="#4C51BF" strokewidth="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M201.694 387.105C231.686 417.098 280.312
417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8
313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2
230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8
179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                            fill="white" />
                    </svg>
                    <span class="text-white text-2xl mx-2 fontsemibold">DASHBOARD</span>
                </div>
            </div>

            <hr>
            <nav nav class="mt-5">
                <a class="flex items-center mt-4 py-2 px-6 hover:bgopacity-25 hover:text-gray-100 {{ Request::is('admin/dashboard*') ? '
bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}"
                    href="{{ route('admin.dashboard.index') }}">
                    <svg class="w-6 h-6" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" strokelinejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0
01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2
2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2
0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0
01-2-2v-2z">
                        </path>
                    </svg>
                    <span class="mx-3">Dashboard</span>
                </a>
                <a class="flex items-center mt-4 py-2 px-6 hover:bgopacity-25 hover:text-gray-100 {{ Request::is('admin/categories*') ? '
bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}"
                    href="{{ route('admin.categories.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>
                    <span class="mx-3">Kategori</span>
                </a>

                <a class="flex items-center mt-4 py-2 px-6 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/posts*') ? ' bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}"
                    href="{{ route('admin.posts.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                    </svg>

                    <span class="mx-3">Posts</span>
                </a>

                <a class="flex items-center mt-4 py-2 px-6 hover:bggray-700 hover:bg-opacity-25 hover:text-gray-100 {{
Request::is('admin/galery*') ? ' bg-gray-700 bg-opacity-25 textgray-100' : 'text-gray-500' }}"
                    href="{{route('admin.galery.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <span class="mx-3">Galery</span>
                </a>
                <a class="flex items-center mt-4 py-2 px-6 hover:bg-opacity-25 hover:text-gray-100 {{ Request::is('admin/photo*') ? ' bg-gray-700 bg-opacity-25 text-gray-100' : 'text-gray-500' }}"
                    href="{{route('admin.photos.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                    </svg>

                    <span class="mx-3">Photo</span>
                </a>
                <a class="flex items-center mt-4 py-2 px-6 hover:bggray-700 hover:bg-opacity-25 hover:text-gray-100 {{
Request::is('admin/massage*') ? ' bg-gray-700 bg-opacity-25 textgray-100' : 'text-gray-500' }}"
                    href="{{   route('admin.message.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>

                    <span class="mx-3">Message</span>
                </a>



                <a class="flex items-center mt-4 py-2 px-6 hover:bggray-700 hover:bg-opacity-25 hover:text-gray-100 {{
Request::is('admin/profilesekolah*') ? ' bg-gray-700 bg-opacity-25 textgray-100' : 'text-gray-500' }}"
                    href="{{   route('admin.profile_sekolah.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                    <span class="mx-3">Profile Sekolah</span>
                </a>
                <a class="flex items-center mt-4 py-2 px-6 hover:bggray-700 hover:bg-opacity-25 hover:text-gray-100 {{
Request::is('admin/manajemenadmin*') ? ' bg-gray-700 bg-opacity-25 textgray-100' : 'text-gray-500' }}"
                    href="{{   route('admin.users.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>

                    <span class="mx-3">Manajemen Admin</span>
                </a>

                <a class="flex items-center mt-4 py-2 px-6 hover:bggray-700 hover:bg-opacity-25 hover:text-gray-100 {{
Request::is('admin/profilesaya*') ? ' bg-gray-700 bg-opacity-25 textgray-100' : 'text-gray-500' }}"
                    href="{{   route('admin.profile.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="mx-3">Admin</span>
                </a>
                <a class="flex items-center mt-4 py-2 px-6 hover:bggray-700 hover:bg-opacity-25 hover:text-gray-100 {{
Request::is('admin/slider*') ? ' bg-gray-700 bg-opacity-25 textgray-100' : 'text-gray-500' }}"
                    href="{{   route('admin.slider.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                    <span class="mx-3">Slider</span>
                </a>

            </nav>
        </div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center py-4 px-6
bg-white">

                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="textgray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11"
                                stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center">
                    <div x-data="{ dropdownOpen: false }"
                        class="relative">
                        <button @click="dropdownOpen = ! dropdownOpen"
                            class="relative block h-8 w-8 rounded-full
overflow-hidden shadow focus:outline-none">
                            <img class="h-full w-full object-cover"
                                src="{{ auth()->user()->avatar }}">
                        </button>
                        <div x-show="dropdownOpen" @click="dropdownOpen
= false"
                            class="fixed inset-0 h-full w-full
z-10"></div>
                        <div x-show="dropdownOpen"
                            class="absolute right-0 mt-2 w-48 bg-white
rounded-md overflow-hidden shadow-sm z-10">
                            <div class="block px-4 py-2 text-sm textgray-700">
                                {{ auth()->user()->name }}
                            </div>
                            <hr>
                            <!-- Kembali ke Homepage -->
                            <a href="{{ url('/') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Homepage</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm textgray-700 hover:bg-indigo-600 hover:text-white">Logout</a>
                            <form id="logout-form" action="{{
route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            @yield('content')
        </div>
    </div>
    <script>
        // Ambil elemen yang menyimpan pesan session
        const alertData = document.getElementById('alert-data');

        // Ambil pesan dari session
        const successMessage = alertData.getAttribute('data-success-message');
        const errorMessage = alertData.getAttribute('data-error-message');

        // Tampilkan SweetAlert jika ada pesan sukses
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL!',
                text: successMessage,
                showConfirmButton: false,
                timer: 3000
            });
        }

        // Tampilkan SweetAlert jika ada pesan error
        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'GAGAL!',
                text: errorMessage,
                showConfirmButton: false,
                timer: 3000
            });
        }
    </script>
</body>

</html>