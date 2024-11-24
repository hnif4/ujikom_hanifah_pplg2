@extends('layouts.app', ['title' => 'Dashboard - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-200 via-gray-400 to-teal-500 text-gray-800">
    <div class="container mx-auto px-6 py-8">
        <!-- Welcome Message -->
        <div class="bg-white rounded-2xl shadow-sm p-8 mb-8 border border-primary-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang, {{ auth()->user()->name }}!</h2>
            <p class="text-gray-600">Kelola konten website Anda melalui dashboard admin ini.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @foreach ([
                ['count' => $Posts, 'label' => 'POSTINGAN', 'icon' => 'info-circle', 'color' => 'primary'],
                ['count' => $galery, 'label' => 'GALERI', 'icon' => 'image', 'color' => 'primary'],
                ['count' => $photo, 'label' => 'FOTO', 'icon' => 'photo', 'color' => 'primary'],
                ['count' => $message, 'label' => 'PESAN', 'icon' => 'message', 'color' => 'primary']
            ] as $item)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-primary-100 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-primary-50">
                        @if ($item['icon'] == 'info-circle')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2.25m0 3.75h.008v.008H12V15.75zM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        @elseif ($item['icon'] == 'image')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        @elseif ($item['icon'] == 'photo')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                        @elseif ($item['icon'] == 'message')
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        @endif
                    </div>
                    <div class="ml-4">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $item['count'] }}</h4>
                        <p class="text-sm text-gray-500">{{ $item['label'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-sm p-8 border border-primary-100">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Aksi Cepat</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.posts.create') }}" 
                   class="flex items-center p-4 bg-primary-50 rounded-xl hover:bg-primary-100 transition-all duration-300">
                    <i class="fas fa-plus-circle mr-3 text-xl text-primary-600"></i>
                    <span class="text-sm font-medium text-gray-700">Tambah Postingan</span>
                </a>
                <a href="{{ route('admin.galery.create') }}" 
                   class="flex items-center p-4 bg-primary-50 rounded-xl hover:bg-primary-100 transition-all duration-300">
                    <i class="fas fa-images mr-3 text-xl text-primary-600"></i>
                    <span class="text-sm font-medium text-gray-700">Tambah Galeri</span>
                </a>
                <a href="{{ route('admin.photos.create') }}" 
                   class="flex items-center p-4 bg-primary-50 rounded-xl hover:bg-primary-100 transition-all duration-300">
                    <i class="fas fa-camera mr-3 text-xl text-primary-600"></i>
                    <span class="text-sm font-medium text-gray-700">Upload Foto</span>
                </a>
                <a href="{{ route('admin.message.index') }}" 
                   class="flex items-center p-4 bg-primary-50 rounded-xl hover:bg-primary-100 transition-all duration-300">
                    <i class="fas fa-envelope mr-3 text-xl text-primary-600"></i>
                    <span class="text-sm font-medium text-gray-700">Lihat Pesan</span>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection