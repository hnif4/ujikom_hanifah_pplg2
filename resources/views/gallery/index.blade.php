@extends('layouts.frontend')

@section('content')
<section id="all-gallery" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Title Section -->
        <div class="text-center mb-12">
            <h5 class="text-primary-600 font-semibold text-sm tracking-wider uppercase mb-2">Galeri Lengkap</h5>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Semua Dokumentasi Kegiatan</h1>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($all_galeries as $galery)
                @if($galery->photos->first())
                <div class="bg-white rounded-2xl shadow-md overflow-hidden group hover:shadow-lg transition duration-300">
                    <div class="relative h-64">
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
                    <div class="p-6">
                        <h5 class="font-semibold text-gray-900 mb-2 text-lg">{{ $galery->judul }}</h5>
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fas fa-images mr-2"></i>
                            {{ count($galery->photos) }} Foto
                        </p>
                    </div>
                </div>
                @endif
            @endforeach
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
</section>

@push('scripts')
<script>
    let currentGallery = [];
    let currentIndex = 0;

    function openGalleryModal(galleryId) {
        // Fetch gallery photos
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
