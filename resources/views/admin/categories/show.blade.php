@extends('layouts.app', ['title' => 'Kategori - Admin'])

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
        <div class="container mx-auto px-6 py-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="bg-gray-700 p-4">
                    <h2 class="text-white text-xl">Detail Kategori</h2>
                </div>  
                <div class="p-6">
                    <h5 class="text-lg font-semibold">Nama Kategori: {{ $category->nama }}</h5>
                    <p class="mt-2 text-gray-600"><strong>Deskripsi:</strong> {{ $category->deskripsi }}</p>
                    <div class="mt-4">
                        <a href="{{ route('admin.categories.index') }}" class="text-white focus:outline-none bg-gray-700 px-4 py-2 shadow-base rounded-md">Kembali ke Daftar Kategori</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
