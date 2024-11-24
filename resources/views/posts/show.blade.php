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
                <h1 class="text-4xl font-bold text-white mb-4">{{ $post->judul }}</h1>
                <div class="flex flex-wrap items-center text-white/90 space-x-6">
                    <div class="flex items-center space-x-2">
                        <div class="bg-primary-500/20 p-2 rounded-lg">
                            <i class="far fa-user"></i>
                        </div>
                        <span>{{ $post->user ? $post->user->name : 'Admin' }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="bg-primary-500/20 p-2 rounded-lg">
                            <i class="far fa-calendar"></i>
                        </div>
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

                    <!-- Share Buttons -->
                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Bagikan:</h4>
                        <div class="flex flex-wrap gap-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                target="_blank"
                                class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                <i class="fab fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $post->judul }}"
                                target="_blank"
                                class="flex items-center space-x-2 bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 transition duration-300">
                                <i class="fab fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="https://wa.me/?text={{ $post->judul }}%20{{ url()->current() }}"
                                target="_blank"
                                class="flex items-center space-x-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                                <i class="fab fa-whatsapp"></i>
                                <span>WhatsApp</span>
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
                        <div class="group">
                            <a href="{{ route('informasi.show', $relatedPost) }}"
                                class="flex space-x-4 hover:bg-gray-50 p-2 rounded-lg transition duration-300">
                                <img src="{{ asset('storage/' . $relatedPost->image) }}"
                                    alt="{{ $relatedPost->judul }}"
                                    class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1 line-clamp-2 group-hover:text-primary-600 transition duration-300">
                                        {{ $relatedPost->judul }}
                                    </h4>
                                    <div class="text-sm text-gray-500 flex items-center">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ \Carbon\Carbon::parse($relatedPost->tanggal_posts)->format('d M Y') }}
                                    </div>
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

@endsection