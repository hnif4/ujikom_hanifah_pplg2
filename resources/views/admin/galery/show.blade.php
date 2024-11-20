@extends('layouts.app', ['title' => 'Galeri - Admin'])

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
        <div class="container mx-auto px-6 py-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="bg-gray-700 p-4">
                    <h2 class="text-white text-xl">Detail Galeri</h2>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-600">Judul:</h2>
                        <p class="text-gray-800">{{ $galery->judul }}</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-gray-600">Deskripsi:</h2>
                        <p class="text-gray-800">{{ $galery->deskripsi }}</p>
                    </div>

                    @if($galery->post)
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-gray-600">Postingan Terkait:</h2>
                            <p class="text-gray-800"><strong>Judul:</strong> {{ $galery->post->judul }}</p>
                            <p class="text-gray-800"><strong>Isi:</strong> {{ $galery->post->isi }}</p>
                        </div>
                    @else
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-gray-600">Postingan Terkait:</h2>
                            <p class="text-gray-500 italic">Tidak ada post terkait.</p>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('admin.galery.index') }}" class="text-white focus:outline-none bg-gray-700 px-4 py-2 shadow-base rounded-md">Kembali ke Daftar Galeri</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
