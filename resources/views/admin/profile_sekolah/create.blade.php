@extends('layouts.app', ['title' => 'Tambah Profil Sekolah'])

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-xl font-semibold">Tambah Profil Sekolah</h2>

    <form action="{{ route('admin.profile_sekolah.store') }}" method="POST" class="mt-6">
        @csrf
        
        <!-- Judul -->
        <div class="mb-4">
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="judul" id="judul" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <!-- Isi -->
        <div class="mb-4">
            <label for="isi" class="block text-sm font-medium text-gray-700">Isi</label>
            <textarea name="isi" id="isi" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
        </div>

        <!-- Tombol Simpan dan Kembali -->
        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md">SIMPAN</button>
        <a href="{{ route('admin.profile_sekolah.index') }}" class="text-gray-600 ml-2">KEMBALI</a>
    </form>
</div>
@endsection
