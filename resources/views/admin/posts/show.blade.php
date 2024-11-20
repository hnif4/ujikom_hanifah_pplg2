@extends('layouts.app', ['title' => 'Detail Post - Admin'])

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
        <div class="container mx-auto px-6 py-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="bg-gray-700 p-4">
                    <h2 class="text-white text-xl">Detail Post</h2>
                </div>
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-4">{{ $post->judul }}</h1>
                    <p class="mb-2"><strong>Isi:</strong> {{ $post->isi }}</p>
                    <p class="mb-2"><strong>Tanggal Post:</strong> {{ \Carbon\Carbon::parse($post->tanggal_posts)->format('d M Y') }}</p>
                    <p class="mb-2"><strong>Status:</strong> {{ $post->status == 'aktif' ? 'Aktif' : 'Tidak Aktif' }}</p>
                    <p class="mb-2"><strong>Kategori:</strong> {{ $post->category->nama }}</p>

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->judul }}" class="mb-4 rounded shadow">
                    @else
                        <p class="text-gray-500">Tidak ada gambar tersedia.</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('admin.posts.index') }}" class="text-white focus:outline-none bg-gray-700 px-4 py-2 shadow-base rounded-md">Kembali ke Daftar Post</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
