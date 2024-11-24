@extends('layouts.frontend')

@section('content')
<!-- Hero Slider Section -->
<section class="relative">
    <!-- Slider container dengan tinggi yang lebih proporsional -->
    <div class="relative h-[450px] md:h-[500px] overflow-hidden">
        <!-- Slider wrapper -->
        <div class="slider-wrapper flex transition-transform duration-500 h-full" id="sliderWrapper">
            @foreach($sliders as $key => $slider)
            <div class="flex-none w-full h-full relative">
                <img src="{{ $slider->image }}"
                    alt="Slider Image {{ $key + 1 }}"
                    class="w-full h-full object-cover">
                <!-- Gradient overlay yang lebih halus -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>

                <!-- Welcome Text & Quote dengan ukuran yang lebih proporsional -->
                <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 text-center max-w-3xl">
                        {{ $slider->judul }}
                    </h1>
                    <p class="text-base md:text-lg text-center max-w-2xl mx-auto text-gray-200 mb-6">
                        {{ $slider->deskripsi }}
                    </p>
                </div>

                <!-- Link Button dengan posisi yang lebih baik -->
                @if($slider->link)
                <div class="absolute bottom-8 left-1/2 -translate-x-1/2">
                    <a href="{{ $slider->link }}"
                        class="px-5 py-2.5 bg-primary-600/90 hover:bg-primary-700 text-white rounded-lg 
                              transition-all duration-300 transform hover:scale-105 inline-flex items-center shadow-lg backdrop-blur-sm">
                        Selengkapnya
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <!-- Dots Navigation yang lebih elegan -->
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
            @foreach($sliders as $key => $slider)
            <button type="button"
                class="w-2 h-2 rounded-full bg-white/40 hover:bg-white/90 transition-all duration-300 slider-dot"
                data-index="{{ $key }}">
            </button>
            @endforeach
        </div>
    </div>
</section>

<!-- Profile Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Logo & Description -->
            <div class="flex flex-col items-center space-y-6">
                <div class="text-center md:text-left">
                    @foreach($profiles as $profile)
                    @if($profile->id == 3)
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">{{ $profile->judul }}</h2>
                    <div class="prose prose-lg text-gray-600 max-w-xl">
                        {!! nl2br(e($profile->isi)) !!}
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>

            <!-- Visi & Misi dengan desain card yang lebih menarik -->
            <div class="space-y-8">
                @foreach($profiles as $profile)
                @if($profile->id == 2)
                <!-- Visi -->
                <div class="bg-primary-50 rounded-2xl p-8 border border-primary-100 hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="bg-primary-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-graduation-cap text-primary-600 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-primary-700">{{ $profile->judul }}</h3>
                    </div>
                    <div class="prose prose-lg text-gray-600">
                        {!! nl2br(e($profile->isi)) !!}
                    </div>
                </div>
                @endif
                @endforeach

                @foreach($profiles as $profile)
                @if($profile->id == 1)
                <!-- Misi -->
                <div class="bg-primary-50 rounded-2xl p-8 border border-primary-100 hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="bg-primary-100 p-3 rounded-lg mr-4">
                            <i class="fas fa-bullseye text-primary-600 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-primary-700">{{ $profile->judul }}</h3>
                    </div>
                    <div class="prose prose-lg text-gray-600">
                        {!! nl2br(e($profile->isi)) !!}
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h5 class="text-primary-600 font-semibold text-sm tracking-wider uppercase mb-2">Galeri Sekolah</h5>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Dokumentasi Kegiatan</h1>
        </div>

        <div class="relative px-4">
            <!-- Gallery Container -->
            <div class="flex overflow-x-auto custom-scrollbar gap-8 py-6 scroll-smooth" id="galleryWrapper">
                @foreach($frontend_galeries->take(5) as $galery)
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

        <!-- View All Button -->
        <div class="text-center mt-8">
            <a href="/gallery"
                class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition duration-300">
                <span>Lihat Semua Galeri</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
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

<!-- Informasi & Agenda Section -->
<section id="informasi-agenda" class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Informasi -->
            <div>
                <div class="text-center mb-8">
                    <h5 class="text-primary-600 font-semibold text-sm tracking-wider uppercase mb-2">Informasi Terbaru</h5>
                    <h1 class="text-2xl font-bold text-gray-900">Berita & Pengumuman</h1>
                </div>

                <div class="space-y-4">
                    @foreach($informasiPosts->take(3) as $post)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex flex-col h-full">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                alt="{{ $post->judul }}"
                                class="w-full h-40 object-cover">
                            <div class="p-4">
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    {{ \Carbon\Carbon::parse($post->tanggal_posts)->format('d M Y') }}
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $post->judul }}</h3>
                                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($post->isi, 80) }}</p>
                                <a href="{{ route('informasi.show', $post) }}"
                                    class="inline-flex items-center text-primary-600 hover:text-primary-700 transition-colors duration-300 text-sm group">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('informasi.index') }}"
                        class="inline-block px-6 py-3 bg-primary-600 text-white rounded-lg text-sm font-semibold hover:bg-primary-700 transition-colors duration-300 shadow-sm">
                        Lihat Semua Informasi
                    </a>
                </div>
            </div>

            <!-- Agenda -->
            <div>
                <div class="text-center mb-8">
                    <h5 class="text-primary-600 font-semibold text-sm tracking-wider uppercase mb-2">Agenda Sekolah</h5>
                    <h1 class="text-2xl font-bold text-gray-900">Upcoming Events</h1>
                </div>

                <div class="space-y-4">
                    @foreach($agendaPosts->take(6) as $agenda)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:-translate-x-1 hover:shadow-lg border-l-4 border-primary-600 p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="far fa-calendar-alt mr-2"></i>
                                {{ \Carbon\Carbon::parse($agenda->tanggal_posts)->format('d M Y') }}
                                <!-- Countdown/Timeago -->
                                @php
                                $agendaDate = \Carbon\Carbon::parse($agenda->tanggal_posts)->startOfDay();
                                $now = \Carbon\Carbon::now()->startOfDay();
                                $isPast = $agendaDate->isPast();
                                $diffInDays = $now->diffInDays($agendaDate, false);

                                if ($isPast) {
                                // Untuk agenda yang sudah lewat
                                $diffInDays = abs($diffInDays); // Mengubah ke positif
                                if ($diffInDays == 0) {
                                $timeStatus = 'Hari ini';
                                } elseif ($diffInDays == 1) {
                                $timeStatus = 'Kemarin';
                                } elseif ($diffInDays < 7) {
                                    $timeStatus=$diffInDays . ' hari yang lalu' ;
                                    } elseif ($diffInDays < 30) {
                                    $weeks=floor($diffInDays / 7);
                                    $timeStatus=$weeks . ' minggu yang lalu' ;
                                    } elseif ($diffInDays < 365) {
                                    $months=floor($diffInDays / 30);
                                    $timeStatus=$months . ' bulan yang lalu' ;
                                    } else {
                                    $years=floor($diffInDays / 365);
                                    $timeStatus=$years . ' tahun yang lalu' ;
                                    }
                                    } else {
                                    // Untuk agenda yang akan datang
                                    if ($diffInDays==0) {
                                    $timeStatus='Hari ini' ;
                                    } elseif ($diffInDays==1) {
                                    $timeStatus='Besok' ;
                                    } else {
                                    $timeStatus='H-' . $diffInDays;
                                    }
                                    }
                                    @endphp
                                    <span class="ml-2 px-2 py-1 rounded-full text-xs {{ $isPast ? 'bg-gray-100 text-gray-600' : 'bg-primary-100 text-primary-600' }}">
                                    {{ $timeStatus }}
                                    </span>
                            </div>
                            @if($agenda->lokasi)
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $agenda->lokasi }}
                            </div>
                            @endif
                        </div>
                        <h4 class="text-base font-bold text-gray-900 mb-2">{{ $agenda->judul }}</h4>
                        <p class="text-gray-600 mb-3 text-sm">{{ Str::limit($agenda->isi, 80) }}</p>
                        <a href="{{ route('agenda.show', $agenda) }}"
                            class="inline-flex items-center text-primary-600 hover:text-primary-700 transition-colors duration-300 text-sm group">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('agenda.index') }}"
                        class="inline-block px-6 py-3 bg-primary-600 text-white rounded-lg text-sm font-semibold hover:bg-primary-700 transition-colors duration-300 shadow-sm">
                        Lihat Semua Agenda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Contact & Maps Section -->
<section id="maps" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Hubungi Kami</h2>
                <p class="text-gray-600 mb-6">Jika ada pertanyaan, silakan kirim pesan kepada kami.</p>

                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text"
                            name="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                        <input type="email"
                            name="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Pesan</label>
                        <textarea name="message"
                            rows="5"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            required></textarea>
                    </div>
                    <button type="submit"
                        class="w-full bg-primary-600 text-white font-medium py-3 px-4 rounded-lg hover:bg-primary-700 transition-colors duration-300 shadow-sm">
                        <i class="far fa-paper-plane mr-2"></i>
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Maps -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <h2 class="text-2xl font-bold text-gray-900 p-8 pb-4">Lokasi Kami</h2>
                <div class="h-[500px]">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.0498825216855!2d106.82211897403128!3d-6.640728064915646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1730303117624!5m2!1sid!2sid"
                        class="w-full h-full border-0"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Slider functionality
    (function() {
        var sliderWrapper = document.getElementById('sliderWrapper');
        var dots = document.querySelectorAll('.slider-dot');
        var currentSlide = 0;
        var totalSlides = "{{ $sliders->count() }}";
        var slideInterval = null;

        function updateSlider() {
            if (!sliderWrapper) return;

            sliderWrapper.style.transform = 'translateX(-' + (currentSlide * 100) + '%)';

            dots.forEach(function(dot, index) {
                if (index === currentSlide) {
                    dot.classList.add('bg-white');
                    dot.classList.remove('bg-white/50');
                } else {
                    dot.classList.remove('bg-white');
                    dot.classList.add('bg-white/50');
                }
            });
        }

        dots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                currentSlide = parseInt(this.getAttribute('data-index'), 10);
                updateSlider();
                resetInterval();
            });
        });

        function nextSlide() {
            currentSlide = (currentSlide + 1) % parseInt(totalSlides, 10);
            updateSlider();
        }

        function resetInterval() {
            if (slideInterval) {
                clearInterval(slideInterval);
            }
            slideInterval = setInterval(nextSlide, 5000);
        }

        function startSlider() {
            updateSlider();
            resetInterval();
        }

        startSlider();

        if (sliderWrapper) {
            sliderWrapper.addEventListener('mouseenter', function() {
                if (slideInterval) {
                    clearInterval(slideInterval);
                }
            });

            sliderWrapper.addEventListener('mouseleave', function() {
                resetInterval();
            });
        }
    })();

    // Gallery functionality
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