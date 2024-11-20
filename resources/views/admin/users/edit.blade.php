@extends('layouts.app', ['title' => 'Edit Petugas'])

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-blue-600 mb-6">Edit Petugas</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="mt-6 bg-white shadow-lg p-6 rounded-lg overflow-y-auto max-h-[70vh]" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama User -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-800">Nama Petugas</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
        </div>

        <!-- Email User -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-800">Email Petugas</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
        </div>

        <!-- Status User -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-800">Status Petugas</label>
            <select name="status" id="status" class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
                <option value="aktif" {{ $user->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ $user->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <!-- Gambar Profil -->
        <div class="mb-4">
            <label for="profile_image" class="block text-sm font-medium text-gray-800">Gambar Profil</label>
            <div class="flex items-center mb-2">
                @if($user->profile_image)
                    <img src="{{ Storage::url($user->profile_image) }}" alt="{{ $user->name }}" class="w-32 h-32 object-cover mr-4 rounded-md shadow-sm">
                    <span class="text-gray-600">Gambar saat ini</span>
                @else
                    <span class="text-gray-600">Tidak ada gambar</span>
                @endif
            </div>
            <input type="file" name="profile_image" id="profile_image" class="mt-1 block w-full p-3 border border-blue-300 rounded-md">
            <p class="mt-2 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar.</p>
        </div>

        <!-- Tombol Simpan dan Kembali -->
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">SIMPAN</button>
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 px-4 py-2 ml-4 hover:text-blue-800">KEMBALI</a>
        </div>
    </form>
</div>
@endsection
