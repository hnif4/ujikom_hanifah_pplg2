@extends('layouts.app', ['title' => 'Tambah Petugas'])

@section('content')
<div class="container mx-auto px-6 py-8 max-h-screen overflow-y-auto">
    <h2 class="text-xl font-semibold">Tambah Petugas</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" class="mt-6" enctype="multipart/form-data">
        @csrf
        
        <!-- Nama User -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Petugas</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <!-- Email User -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Petugas</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <!-- Password User -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <!-- Status User -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-800">Status Petugas</label>
            <select name="status" id="status" class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
                <option value="aktif">Aktif</option>
                <option value="tidak aktif">Tidak Aktif</option>
            </select>
        </div>

        <!-- Input untuk Unggah Gambar Profil -->
        <div class="mb-4">
            <label for="profile_image" class="block text-sm font-medium text-gray-700">Unggah Gambar Profil</label>
            <input type="file" name="profile_image" id="profile_image" accept="image/*" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md">SIMPAN</button>
        <a href="{{ route('admin.users.index') }}" class="text-gray-600 ml-2">KEMBALI</a>
    </form>
</div>
@endsection
