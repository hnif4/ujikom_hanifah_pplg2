@extends('layouts.app', ['title' => 'Edit Kategori - Admin'])

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-blue-600 mb-6">Edit Kategori</h2>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="mt-6 bg-white shadow-lg p-6 rounded-lg overflow-y-auto max-h-[70vh]">
        @csrf
        @method('PUT')

        <!-- Nama Kategori -->
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-800">Nama Kategori</label>
            <input type="text" name="nama" id="nama" 
                   value="{{ old('nama', $category->nama) }}" 
                   class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
            @error('nama')
                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-800">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" 
                      class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>{{ old('deskripsi', $category->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
            @enderror
        </div>

        <!-- Tombol Simpan dan Kembali -->
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Update Kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="text-blue-600 px-4 py-2 ml-4 hover:text-blue-800">Kembali</a>
        </div>
    </form>
</div>
@endsection
