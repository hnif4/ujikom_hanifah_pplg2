@extends('layouts.frontend')

@section('content')
<div class="pt-16">
    <!-- Hero Image -->
    <div class="relative h-[400px]">
        <img src="{{ asset('storage/' . $post->image) }}"
             alt="{{ $post->judul }}"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col justify-end">
            <div class="container mx-auto px-4 pb-12">
                <h1 class="text-4xl font-bold text-white mb-6">{{ $post->judul }}</h1>
                <div class="flex flex-wrap items-center gap-6">
                    <!-- Tanggal -->
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 text-white">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span>{{ \Carbon\Carbon::parse($post->tanggal_posts)->format('d M Y') }}</span>
                    </div>
                    
                    <!-- Lokasi -->
                    @if($post->lokasi)
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 text-white">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $post->lokasi }}</span>
                    </div>
                    @endif

                    <!-- Status -->
                    @php
                        $agendaDate = \Carbon\Carbon::parse($post->tanggal_posts)->startOfDay();
                        $now = \Carbon\Carbon::now()->startOfDay();
                        $isPast = $agendaDate->isPast();
                        $diffInDays = $now->diffInDays($agendaDate, false);
                        
                        if ($isPast) {
                            $timeStatus = $diffInDays == 0 ? 'Hari ini' : 
                                        ($diffInDays == 1 ? 'Kemarin' : 
                                        ($diffInDays < 7 ? $diffInDays . ' hari yang lalu' : 
                                        ($diffInDays < 30 ? floor($diffInDays/7) . ' minggu yang lalu' : 
                                        ($diffInDays < 365 ? floor($diffInDays/30) . ' bulan yang lalu' : 
                                        floor($diffInDays/365) . ' tahun yang lalu'))));
                        } else {
                            $timeStatus = $diffInDays == 0 ? 'Hari ini' : 
                                        ($diffInDays == 1 ? 'Besok' : 'H-' . $diffInDays);
                        }
                    @endphp
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 text-white">
                        <i class="fas fa-clock mr-2"></i>
                        <span>{{ $timeStatus }}</span>
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
                    <!-- Event Details -->
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($post->isi)) !!}
                    </div>

                    <!-- Gallery Section -->
                    @if($postGaleries->count() > 0)
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Dokumentasi Kegiatan</h3>
                        <div class="relative px-4">
                            <!-- Gallery Container -->
                            <div class="flex overflow-x-auto custom-scrollbar gap-8 py-6 scroll-smooth" id="galleryWrapper">
                                @foreach($postGaleries as $galery)
                                @if($galery->photos->first())
                                <div class="flex-none w-80">
                                    <div class="bg-white rounded-2xl shadow-md overflow-hidden group hover:shadow-lg transition duration-300">
                                        <div class="relative h-56">
                                            <!-- Thumbnail Image -->
                                            <img src="{{ asset('storage/' . $galery->photos->first()->isi_foto) }}"
                                                alt="{{ $galery->judul }}"
                                                class="w-full h-full object-cover">
                                            
                                            <!-- Overlay with Preview Button -->
                                            <div class="absolute inset-0 bg-primary-600/80 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center">
                                                <button onclick="openGalleryModal('{{ $galery->id }}')" 
                                                        class="text-white bg-white/20 hover:bg-white/30 p-3 rounded-full transition duration-300">
                                                    <i class="fas fa-expand-alt text-xl"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="p-5">
                                            <h5 class="font-semibold text-gray-900 mb-2 text-lg">{{ $galery->judul }}</h5>
                                            <p class="text-sm text-gray-500 flex items-center">
                                                <i class="fas fa-images mr-2"></i>
                                                {{ count($galery->photos) }} Foto
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>

                            <!-- Navigation Buttons -->
                            <button type="button"
                                id="scrollLeftBtn"
                                class="absolute left-0 top-1/2 -translate-y-1/2 w-12 h-12 bg-primary-600/90 text-white rounded-full shadow-lg flex items-center justify-center hover:bg-primary-700 transition-colors duration-300">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button type="button"
                                id="scrollRightBtn"
                                class="absolute right-0 top-1/2 -translate-y-1/2 w-12 h-12 bg-primary-600/90 text-white rounded-full shadow-lg flex items-center justify-center hover:bg-primary-700 transition-colors duration-300">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    @endif

                    <!-- Google Calendar Button -->
                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Tambahkan ke Kalender:</h4>
                        <a href="https://www.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($post->judul) }}&dates={{ \Carbon\Carbon::parse($post->tanggal_posts)->format('Ymd\THis') }}/{{ \Carbon\Carbon::parse($post->tanggal_posts)->addHours(1)->format('Ymd\THis') }}&details={{ urlencode($post->isi) }}&location={{ urlencode($post->lokasi ?? '') }}&sf=true&output=xml"
                           target="_blank"
                           class="inline-flex items-center space-x-2 bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition duration-300">
                            <i class="fab fa-google"></i>
                            <span>Tambahkan ke Google Calendar</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="md:col-span-1">
                <!-- Related Agendas -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Agenda Lainnya</h3>
                    <div class="space-y-6">
                        @foreach($relatedAgendas as $relatedAgenda)
                        <div class="group">
                            <a href="{{ route('agenda.show', $relatedAgenda) }}" 
                               class="flex space-x-4 hover:bg-gray-50 p-2 rounded-lg transition duration-300">
                                <img src="{{ asset('storage/' . $relatedAgenda->image) }}"
                                     alt="{{ $relatedAgenda->judul }}"
                                     class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1 line-clamp-2 group-hover:text-primary-600 transition duration-300">
                                        {{ $relatedAgenda->judul }}
                                    </h4>
                                    <div class="text-sm text-gray-500 flex items-center">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ \Carbon\Carbon::parse($relatedAgenda->tanggal_posts)->format('d M Y') }}
                                    </div>
                                    @if($relatedAgenda->lokasi)
                                    <div class="text-sm text-gray-500 flex items-center mt-1">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        {{ $relatedAgenda->lokasi }}
                                    </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Modal -->
<div id="galleryModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/90" onclick="closeGalleryModal()"></div>
    <div class="relative h-full flex items-center justify-center p-4">
        <!-- Close Button -->
        <button onclick="closeGalleryModal()" 
                class="absolute top-4 right-4 text-white hover:text-primary-300 z-10">
            <i class="fas fa-times text-2xl"></i>
        </button>

        <!-- Gallery Navigation -->
        <button id="prevPhoto" class="absolute left-4 text-white hover:text-primary-300">
            <i class="fas fa-chevron-left text-3xl"></i>
        </button>
        
        <!-- Image Container -->
        <div class="max-w-4xl w-full">
            <img id="modalImage" src="" alt="" class="max-h-[80vh] mx-auto">
            <div class="text-center mt-4">
                <h3 id="modalTitle" class="text-white text-xl font-semibold"></h3>
                <p id="photoInfo" class="text-gray-400 mt-2"></p>
            </div>
        </div>

        <button id="nextPhoto" class="absolute right-4 text-white hover:text-primary-300">
            <i class="fas fa-chevron-right text-3xl"></i>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Gallery scroll functionality
(function() {
    var galleryWrapper = document.getElementById('galleryWrapper');
    var scrollLeftBtn = document.getElementById('scrollLeftBtn');
    var scrollRightBtn = document.getElementById('scrollRightBtn');

    if (galleryWrapper && scrollLeftBtn && scrollRightBtn) {
        var scrollAmount = 320;

        scrollLeftBtn.addEventListener('click', function() {
            galleryWrapper.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        scrollRightBtn.addEventListener('click', function() {
            galleryWrapper.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });

        function updateScrollButtons() {
            var isAtStart = galleryWrapper.scrollLeft <= 0;
            var isAtEnd = galleryWrapper.scrollLeft + galleryWrapper.clientWidth >= galleryWrapper.scrollWidth;

            scrollLeftBtn.style.display = isAtStart ? 'none' : 'flex';
            scrollRightBtn.style.display = isAtEnd ? 'none' : 'flex';
        }

        galleryWrapper.addEventListener('scroll', updateScrollButtons);
        updateScrollButtons();
        window.addEventListener('resize', updateScrollButtons);
    }
})();

// Modal functionality
let currentGallery = [];
let currentIndex = 0;

function openGalleryModal(galleryId) {
    fetch(`/api/gallery/${galleryId}/photos`)
        .then(response => response.json())
        .then(data => {
            currentGallery = data;
            currentIndex = 0;
            showPhoto(currentIndex);
            document.getElementById('galleryModal').classList.remove('hidden');
        });
}

function closeGalleryModal() {
    document.getElementById('galleryModal').classList.add('hidden');
}

function showPhoto(index) {
    if (currentGallery.length === 0) return;
    
    const photo = currentGallery[index];
    document.getElementById('modalImage').src = `/storage/${photo.isi_foto}`;
    document.getElementById('modalTitle').textContent = photo.judul_foto;
    document.getElementById('photoInfo').textContent = `Foto ${index + 1} dari ${currentGallery.length}`;
}

document.getElementById('prevPhoto').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + currentGallery.length) % currentGallery.length;
    showPhoto(currentIndex);
});

document.getElementById('nextPhoto').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % currentGallery.length;
    showPhoto(currentIndex);
});

// Keyboard navigation
document.addEventListener('keydown', (e) => {
    if (document.getElementById('galleryModal').classList.contains('hidden')) return;
    
    if (e.key === 'ArrowLeft') document.getElementById('prevPhoto').click();
    if (e.key === 'ArrowRight') document.getElementById('nextPhoto').click();
    if (e.key === 'Escape') closeGalleryModal();
});
</script>
@endpush
