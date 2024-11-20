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
                <div class="flex flex-wrap items-center text-white/80 space-x-6">
                    <!-- User info with null check -->
                    <div class="flex items-center">
                        <i class="far fa-user mr-2"></i>
                        <span>{{ $post->user ? $post->user->name : 'Admin' }}</span>
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
                    <!-- Event Date -->
                    <div class="flex items-center">
                        <i class="far fa-calendar mr-2"></i>
                        <span>Tanggal Pelaksanaan : {{ \Carbon\Carbon::parse($post->tanggal_posts)->format('d M Y') }}</span>
                    </div>
                    
                    <!-- Event Details -->
                    <div class="prose prose-lg max-w-none mt-6">
                        {!! nl2br(e($post->isi)) !!}
                    </div>

                    <!-- Google Calendar Button -->
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Tambahkan ke Google Calendar:</h4>
                        <a href="https://www.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($post->judul) }}&dates={{ \Carbon\Carbon::parse($post->tanggal_posts)->format('Ymd\THis\Z') }}/{{ \Carbon\Carbon::parse($post->tanggal_posts)->addHour(1)->format('Ymd\THis\Z') }}&details={{ urlencode($post->isi) }}&location={{ urlencode($post->lokasi ?? '') }}&sf=true&output=xml"
                           target="_blank"
                           class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors duration-300">
                            <i class="fab fa-google mr-2"></i>Tambahkan ke Google Calendar
                        </a>
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
                </div>
            </div>

            <!-- Sidebar -->
            <div class="md:col-span-1">
                <!-- Related Agendas -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Agenda Lainnya</h3>
                    <div class="space-y-6">
                        @foreach($relatedAgendas as $relatedAgenda)
                            <div class="flex space-x-4">
                                <img src="{{ asset('storage/' . $relatedAgenda->image) }}"
                                     alt="{{ $relatedAgenda->judul }}"
                                     class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1 line-clamp-2">
                                        <a href="{{ route('agenda.show', $relatedAgenda) }}"
                                           class="hover:text-primary transition-colors duration-300">
                                            {{ $relatedAgenda->judul }}
                                        </a>
                                    </h4>
                                    <div class="text-sm text-gray-500">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ \Carbon\Carbon::parse($relatedAgenda->tanggal_posts)->format('d M Y') }}
                                    </div>
                                    @if($relatedAgenda->lokasi)
                                        <div class="text-sm text-gray-500 mt-1">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            {{ $relatedAgenda->lokasi }}
                                        </div>
                                    @endif
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
