@extends('layouts.frontend')

@section('content')
<div class="pt-16">
    <!-- Hero Image -->
    <div class="relative h-[400px]">
        <img src="{{ asset('storage/' . $post->image) }}" 
             alt="{{ $post->judul }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex flex-col justify-end">
            <div class="container mx-auto px-4 pb-12">
                <h1 class="text-4xl font-bold text-white mb-4">{{ $post->judul }}</h1>
                <div class="flex items-center text-white/80 space-x-6">
                    <div class="flex items-center">
                        <i class="far fa-user mr-2"></i>
                        <span>{{ $post->user ? $post->user->name : 'Admin' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-calendar mr-2"></i>
                        <span>{{ \Carbon\Carbon::parse($post->tanggal_posts)->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($post->isi)) !!}
                    </div>

                    <!-- Gallery Section -->
                    @if($postGaleries->isNotEmpty())
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Dokumentasi Kegiatan</h3>
                        @foreach($postGaleries as $galery)
                        <div class="mb-8">
                            <h4 class="text-xl font-semibold text-gray-800 mb-4">{{ $galery->judul }}</h4>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($galery->photos as $photo)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $photo->isi_foto) }}"
                                         alt="{{ $photo->judul_foto }}"
                                         class="w-full h-48 object-cover rounded-lg">
                                    <div class="absolute inset-0 bg-primary/80 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                                        <a href="{{ asset('storage/' . $photo->isi_foto) }}"
                                           data-lightbox="gallery-{{ $galery->id }}"
                                           class="text-white text-2xl hover:scale-110 transition-transform duration-300"
                                           title="{{ $photo->judul_foto }}">
                                            <i class="fas fa-search-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="mt-8 pt-8 border-t">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Bagikan:</h4>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                               target="_blank"
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                                <i class="fab fa-facebook-f mr-2"></i>Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $post->judul }}"
                               target="_blank"
                               class="bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 transition-colors duration-300">
                                <i class="fab fa-twitter mr-2"></i>Twitter
                            </a>
                            <a href="https://wa.me/?text={{ $post->judul }}%20{{ url()->current() }}"
                               target="_blank"
                               class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-300">
                                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="md:col-span-1">
                <!-- Related Posts -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Informasi Terkait</h3>
                    <div class="space-y-6">
                        @foreach($relatedPosts as $relatedPost)
                        <div class="flex space-x-4">
                            <img src="{{ asset('storage/' . $relatedPost->image) }}"
                                 alt="{{ $relatedPost->judul }}"
                                 class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1 line-clamp-2">
                                    <a href="{{ route('informasi.show', $relatedPost) }}"
                                       class="hover:text-primary transition-colors duration-300">
                                        {{ $relatedPost->judul }}
                                    </a>
                                </h4>
                                <div class="text-sm text-gray-500">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ \Carbon\Carbon::parse($relatedPost->tanggal_posts)->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
