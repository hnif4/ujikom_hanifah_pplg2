@extends('layouts.frontend')

@section('content')
<section id="all-gallery" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h5 class="text-primary font-semibold text-sm tracking-wider uppercase mb-2">Galeri Lengkap</h5>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Semua Dokumentasi Kegiatan</h1>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($all_galeries as $galery)
                @if($galery->photos->first())
                <div class="bg-white rounded-2xl shadow-md overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="relative h-56">
                        <img src="{{ asset('storage/' . $galery->photos->first()->isi_foto) }}" 
                             alt="{{ $galery->judul }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-primary/80 opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <!-- Lightbox Trigger for First Image -->
                            <a href="{{ asset('storage/' . $galery->photos->first()->isi_foto) }}"
                               data-lightbox="gallery-{{ $galery->id }}"
                               class="text-white hover:scale-110 transition-transform duration-300"
                               title="{{ $galery->photos->first()->judul_foto }}">
                                <i class="fas fa-search-plus text-2xl"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-5">
                        <h5 class="font-semibold text-gray-900 mb-2 text-lg">{{ $galery->judul }}</h5>
                        <p class="text-sm text-gray-500">{{ count($galery->photos) }} Foto</p>
                    </div>
                    
                    <!-- Additional Hidden Photos for Lightbox -->
                    @foreach($galery->photos->skip(1) as $photo)
                        <a href="{{ asset('storage/' . $photo->isi_foto) }}"
                           data-lightbox="gallery-{{ $galery->id }}"
                           class="hidden"
                           title="{{ $photo->judul_foto }}"></a>
                    @endforeach
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endsection
