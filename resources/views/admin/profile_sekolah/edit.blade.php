@extends('layouts.app', ['title' => 'Edit Profil Sekolah - Admin'])

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-blue-600 mb-6">Edit Profil Sekolah</h2>
    <form action="{{ route('admin.profile_sekolah.update', $profileSekolah->id) }}" method="POST" class="mt-6 bg-white shadow-lg p-6 rounded-lg overflow-y-auto max-h-[70vh]">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div class="mb-4">
            <label for="judul" class="block text-sm font-medium text-gray-800">Judul</label>
            <input type="text" name="judul" id="judul" 
                   value="{{ old('judul', $profileSekolah->judul) }}" 
                   class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
            @error('judul')
                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
            @enderror
        </div>

        <!-- Isi -->
        <div class="mb-4">
            <label for="isi" class="block text-sm font-medium text-gray-800">Isi</label>
            <textarea name="isi" id="isi" 
                      class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>{{ old('isi', $profileSekolah->isi) }}</textarea>
            @error('isi')
                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
            @enderror
        </div>

        <!-- Tombol Simpan dan Kembali -->
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Update Profil</button>
            <a href="{{ route('admin.profile_sekolah.index') }}" class="text-blue-600 px-4 py-2 ml-4 hover:text-blue-800">Kembali</a>
        </div>
    </form>
</div>
@endsection
