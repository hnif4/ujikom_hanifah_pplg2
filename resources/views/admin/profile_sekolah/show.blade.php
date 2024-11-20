@extends('layouts.app', ['title' => 'Profile Sekolah - Admin'])

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
        <div class="container mx-auto px-6 py-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="bg-gray-700 p-4">
                    <h2 class="text-white text-xl">Profile Sekolah</h2>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-600">Judul:</h2>
                        <p class="text-base text-gray-800">{{ $profileSekolah->judul }}</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-600">Konten:</h2>
                        <p class="text-base text-gray-800">{{ $profileSekolah->isi }}</p>
                    </div>

                    <div class="mt-4 flex space-x-4">
                        <a href="{{ route('admin.profile_sekolah.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Kembali ke Daftar Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
