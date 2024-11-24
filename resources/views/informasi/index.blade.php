@extends('layouts.frontend')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Title Section -->
        <div class="text-center mb-12">
            <h5 class="text-primary-600 font-semibold text-sm tracking-wider uppercase mb-2">Informasi Terbaru</h5>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Berita & Pengumuman</h1>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($informasiPosts as $post)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden group hover:shadow-lg transition duration-300">
                <!-- Gambar -->
                <div class="relative h-56">
                    <img src="{{ asset('storage/' . $post->image) }}" 
                         alt="{{ $post->judul }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white flex items-center text-sm">
                        <i class="far fa-calendar-alt mr-2"></i>
                        {{ \Carbon\Carbon::parse($post->tanggal_posts)->format('d M Y') }}
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">{{ $post->judul }}</h3>

                    <!-- Isi (Ringkas) -->
                    <p class="text-gray-600 mb-4 text-sm line-clamp-3">{{ Str::limit($post->isi, 120) }}</p>
                    
                    <!-- Tombol Baca Selengkapnya -->
                    <a href="{{ route('informasi.show', $post) }}" 
                       class="inline-flex items-center text-primary-600 hover:text-primary-700 transition-colors duration-300 text-sm group">
                        <span>Baca Selengkapnya</span>
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $informasiPosts->links() }}
        </div>
    </div>
</section>
@endsection
