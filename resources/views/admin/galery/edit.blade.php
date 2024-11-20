@extends('layouts.app', ['title' => 'Edit Galeri - Admin'])

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-blue-600 mb-6">Edit Galeri</h2>
    <form action="{{ route('admin.galery.update', $galery->id) }}" method="POST" class="mt-6 bg-white shadow-lg p-6 rounded-lg overflow-y-auto max-h-[70vh]">
        @csrf
        @method('PUT')

        <!-- Judul Galeri -->
        <div class="mb-4">
            <label for="judul" class="block text-sm font-medium text-gray-800">Judul Galeri</label>
            <input type="text" name="judul" id="judul" 
                   value="{{ old('judul', $galery->judul) }}" 
                   class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-800">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" 
                      class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>{{ old('deskripsi', $galery->deskripsi) }}</textarea>
        </div>


        <!-- Dropdown Post -->
        <div class="mb-4">
            <label for="post_id" class="block text-sm font-medium text-gray-800">Pilih Post</label>
            <select name="post_id" id="post_id" class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none">
                <option value="">-- Pilih Post --</option> <!-- Tambahkan opsi default -->
                @foreach($posts as $post)
                    <option value="{{ $post->id }}" {{ $galery->post_id == $post->id ? 'selected' : '' }}>
                        {{ $post->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Simpan dan Kembali -->
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Update Galeri</button>
            <a href="{{ route('admin.galery.index') }}" class="text-blue-600 px-4 py-2 ml-4 hover:text-blue-800">Kembali</a>
        </div>
    </form>
</div>
@endsection
