@extends('layouts.app', ['title' => 'Tambah Posts'])

@section('content')
<div class="container mx-auto px-6 py-8 max-h-screen overflow-y-auto">
    <h2 class="text-xl font-semibold">Tambah Posts</h2>

    <form action="{{ route('admin.posts.store') }}" method="POST" class="mt-6" enctype="multipart/form-data">
        @csrf

        <!-- Display All Validation Errors -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Judul Post -->
        <div class="mb-4">
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Posts</label>
            <input type="text" name="judul" id="judul" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <!-- Isi Post -->
        <div class="mb-4">
            <label for="isi" class="block text-sm font-medium text-gray-700">Isi Posts</label>
            <textarea name="isi" id="isi" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
        </div>

        <!-- Tanggal Post -->
        <div class="mb-4">
            <label for="tanggal_posts" class="block text-sm font-medium text-gray-700">Tanggal Posts</label>
            <input type="date" name="tanggal_posts" id="tanggal_posts" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <!-- Status Post -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-800">Status Posts</label>
            <select name="status" id="status" class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
                <option value="aktif">Aktif</option>
                <option value="tidak aktif">Tidak Aktif</option>
            </select>
        </div>

        <!-- Dropdown Kategori -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="category_id" id="category_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input untuk Unggah Gambar -->
        <div class="mb-4">
    <label for="image" class="block text-sm font-medium text-gray-700">Unggah Gambar</label>
    <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
    @error('image')
        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
    @enderror
</div>


        <!-- Tombol Simpan -->
        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md">SIMPAN</button>
        <a href="{{ route('admin.posts.index') }}" class="text-gray-600 ml-2">KEMBALI</a>
    </form>
</div>
@endsection
