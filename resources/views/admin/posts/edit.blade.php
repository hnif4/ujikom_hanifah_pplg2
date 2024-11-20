@extends('layouts.app', ['title' => 'Edit Posts'])

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-blue-600 mb-6">Edit Posts</h2>

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" class="mt-6 bg-white shadow-lg p-6 rounded-lg overflow-y-auto max-h-[70vh]" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Judul Post -->
        <div class="mb-4">
            <label for="judul" class="block text-sm font-medium text-gray-800">Judul Posts</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $post->judul) }}"
                class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
        </div>

        <!-- Isi Post -->
        <div class="mb-4">
            <label for="isi" class="block text-sm font-medium text-gray-800">Isi Posts</label>
            <textarea name="isi" id="isi" class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>{{ old('isi', $post->isi) }}</textarea>
        </div>

        <!-- Gambar Post -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-800">Gambar Posts</label>

            <!-- Menampilkan gambar saat ini -->
            @if ($post->image)
            <div class="flex items-center mb-2">
                <img
                    src="{{ asset('storage/' . $post->image) }}"
                    alt="{{ $post->judul }}"
                    class="w-32 h-32 object-cover mr-4 rounded-md shadow-sm">
                <span class="text-gray-600">Gambar saat ini</span>
            </div>
            @else
            <p class="text-sm text-gray-500 italic mb-2">Belum ada gambar yang diunggah.</p>
            @endif

            <!-- Input untuk mengganti gambar -->
            <input
                type="file"
                name="image"
                id="image"
                class="mt-1 block w-full p-3 border border-gray-300 rounded-md"
                accept="image/*">

            <!-- Menampilkan pesan error jika ada -->
            @error('image')
            <div class="text-sm text-red-600 mt-2">
                {{ $message }}
            </div>
            @enderror

            <p class="mt-2 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar.</p>
        </div>


        <!-- Tanggal Post -->
        <div class="mb-4">
            <label for="tanggal_posts" class="block text-sm font-medium text-gray-800">Tanggal Posts</label>
            <input type="date" name="tanggal_posts" id="tanggal_posts" value="{{ old('tanggal_posts', $post->tanggal_posts) }}"
                class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
        </div>

        <!-- Status Post -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-800">Status Posts</label>
            <select name="status" id="status" class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
                <option value="aktif" {{ $post->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ $post->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-800">Kategori</label>
            <select name="category_id" id="category_id" class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- User ID -->
        <input type="hidden" name="user_id" value="{{ $post->user_id }}">

        <!-- Tombol Simpan dan Kembali -->
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">SIMPAN</button>
            <a href="{{ route('admin.posts.index') }}" class="text-blue-600 px-4 py-2 ml-4 hover:text-blue-800">KEMBALI</a>
        </div>
    </form>
</div>
@endsection