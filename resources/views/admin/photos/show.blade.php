@extends('layouts.app', ['title' => 'Detail Foto - Admin'])

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="bg-gray-700 p-4">
                <h2 class="text-white text-xl">Detail Foto</h2>
            </div>
            <div class="p-6">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-600">Judul:</h2>
                    <p class="text-base text-gray-800">{{ $photo->judul_foto }}</p>
                </div>

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-600">Galeri:</h2>
                    <p class="text-base text-gray-800">{{ $photo->galery->judul ?? 'Tidak ada Galeri Terkait' }}</p>
                </div>


                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-600">Gambar:</h2>
                    <img src="{{ asset('storage/' . $photo->isi_foto) }}" alt="{{ $photo->judul_foto }}" class="w-full max-w-xs rounded-md">
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.photos.index') }}" class="text-white focus:outline-none bg-gray-700 px-4 py-2 shadow-base rounded-md">Kembali ke Daftar Foto</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection