@extends('layouts.app', ['title' => 'Tambah Galeri'])

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-xl font-semibold">Tambah Galeri</h2>

    <form action="{{ route('admin.galery.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
        @csrf

        <div class="mb-4">
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Galeri</label>
            <input type="text" name="judul" id="judul" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
        </div>


        <!-- Dropdown Post -->
        <div class="form-group mb-4">
            <label for="post_id" class="block text-sm font-medium text-gray-700">Pilih Post</label>
            <select name="post_id" id="post_id" class="form-control mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="">-- Pilih Post --</option> <!-- Tambahkan opsi default -->
                @foreach($posts as $post)
                    <option value="{{ $post->id }}">{{ $post->judul }}</option>
                @endforeach
            </select>
        </div>
        <!-- End Dropdown Post -->

        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md">SIMPAN</button>
        <a href="{{ route('admin.galery.index') }}" class="text-gray-600 ml-2">KEMBALI</a>
    </form>
</div>
@endsection
