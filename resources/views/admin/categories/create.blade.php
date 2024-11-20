@extends('layouts.app', ['title' => 'Tambah Kategori'])

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-xl font-semibold">Tambah Kategori</h2>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="mt-6">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="nama" id="nama" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Kategori</label>
            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
        </div>

        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md">SIMPAN</button>
        <a href="{{ route('admin.categories.index') }}" class="text-gray-600 ml-2">KEMBALI</a>
    </form>
</div>
@endsection
