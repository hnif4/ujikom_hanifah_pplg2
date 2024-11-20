@extends('layouts.app', ['title' => 'Tambah Foto'])

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-semibold mb-4">Tambah Foto</h2>

    <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label for="judul_foto" class="block text-sm font-medium text-gray-700">Judul Foto</label>
            <input type="text" name="judul_foto" id="judul_foto" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-500 focus:ring-opacity-50" required>
            @error('judul_foto')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="galery_id" class="block text-sm font-medium text-gray-700">Galeri</label>
            <select name="galery_id" id="galery_id" class="form-control mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-gray-500 focus:ring-opacity-50" required>
                <option value="" disabled selected>Pilih Galeri</option>
                @foreach($galeries as $galery)
                    <option value="{{ $galery->id }}">
                        {{ $galery->judul }} <!-- Ganti dengan kolom yang sesuai -->
                    </option>
                @endforeach
            </select>
            @error('galery_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Foto (Max: 2 MB)</label>
            <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-gray-500 focus:ring-opacity-50" required>
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">SIMPAN</button>
            <a href="{{ route('admin.photos.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">KEMBALI</a>
        </div>
    </form>
</div>
@endsection
