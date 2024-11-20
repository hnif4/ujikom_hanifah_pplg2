@extends('layouts.frontend')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Informasi Terbaru</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($informasiPosts as $post)
            <div class="bg-white rounded-xl shadow-md p-6 overflow-hidden transition-all duration-300 hover:shadow-lg">
                <div class="flex flex-col justify-between">
                    <!-- Gambar -->
                    <img src="{{ asset('storage/' . $post->image) }}" 
                         alt="{{ $post->judul }}" 
                         class="w-full h-48 object-cover rounded-md mb-4">
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $post->judul }}</h3>

                    <!-- Isi (Ringkas) -->
                    <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($post->isi, 120) }}</p>
                    
                    <!-- Tombol Baca Selengkapnya -->
                    <a href="{{ route('informasi.show', $post) }}" 
                       class="text-primary hover:text-secondary transition-colors duration-300 text-sm">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $informasiPosts->links() }}
        </div>
    </div>
</section>
@endsection
