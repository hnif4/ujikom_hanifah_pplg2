@extends('layouts.app', ['title' => 'Edit Foto'])

@section('content')
<div class="container mx-auto px-6 py-8">
    <h2 class="text-2xl font-bold text-blue-600 mb-6">Edit Foto</h2>

    <form action="{{ route('admin.photos.update', $photo->id) }}" method="POST" class="mt-6 bg-white shadow-lg p-6 rounded-lg overflow-y-auto max-h-[70vh]" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Judul Foto -->
        <div class="mb-4">
            <label for="judul_foto" class="block text-sm font-medium text-gray-800">Judul Foto</label>
            <input type="text" name="judul_foto" id="judul_foto"
                value="{{ old('judul_foto', $photo->judul_foto) }}"
                class="mt-1 block w-full p-3 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none" required>
        </div>

        <!-- Gambar Foto -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-800">Gambar Foto (Max: 2 MB)</label>
            <div class="flex items-center mb-2">
                @if($photo->isi_foto)
                <img src="{{ asset('storage/' . $photo->isi_foto) }}" alt="{{ $photo->judul_foto }}" class="w-32 h-32 object-cover mr-4 rounded-md shadow-sm">
                <span class="text-gray-600">Gambar saat ini</span>
                @endif
            </div>
            <input type="file" name="image" id="image" class="mt-1 block w-full p-3 border border-blue-300 rounded-md">
            <p class="mt-2 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar.</p>

            <!-- Pesan Error -->
            @error('image')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>


        <!-- Galeri -->
        <div class="form-group mb-4">
            <label for="galery_id" class="block text-sm font-medium text-gray-700">Galeri</label>
            <select name="galery_id" id="galery_id" class="form-control mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                <option value="" disabled selected>Pilih Galeri</option>
                @foreach($galeries as $galery)
                <option value="{{ $galery->id }}" {{ $photo->galery_id == $galery->id ? 'selected' : '' }}>
                    {{ $galery->judul }} <!-- Pastikan kolom yang sesuai -->
                </option>
                @endforeach
            </select>
        </div>



        <!-- User ID -->
        <input type="hidden" name="user_id" value="{{ $photo->user_id }}">

        <!-- Tombol Simpan dan Kembali -->
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">SIMPAN</button>
            <a href="{{ route('admin.photos.index') }}" class="text-blue-600 px-4 py-2 ml-4 hover:text-blue-800">KEMBALI</a>
        </div>
    </form>
</div>
@endsection