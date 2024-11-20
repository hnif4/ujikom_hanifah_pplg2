<!-- Footer Start -->
<div class="container-fluid footer bg-dark text-body py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="mb-4 text-white">LMS SMKN 4 BOGOR</h4>
                    <p class="mb-4 text-secondary">Akses pembelajaran online SMKN 4 Bogor melalui Learning Management System (LMS). Sistem pembelajaran digital untuk meningkatkan kualitas pendidikan.</p>
                    <div class="position-relative mx-auto">
                        <a href="https://pjj.smkn4bogor.sch.id/" target="_blank" class="btn btn-primary w-100 py-3">
                            <i class="fas fa-graduation-cap me-2"></i>Akses LMS
                        </a>
                    </div>
                </div>
            </div>
             <!-- Quick Links -->
             <div class="col-md-4 mb-4">
                <h5 class="text-uppercase mb-3">Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Beranda</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Galeri</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Agenda</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Kontak</a></li>
                </ul>
            </div>
            <!-- Contact Information -->
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase mb-3">Kontak Kami</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Merdeka No. 123, Bogor</p>
                <p><i class="fas fa-phone-alt me-2"></i> +62 123 456 789</p>
                <p><i class="fas fa-envelope me-2"></i> info@gamaki.sch.id</p>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="mb-4 text-white">Galeri Terbaru</h4>
                    <div class="row g-2">
                        @foreach($frontend_galeries as $galery)
                            @if($galery->photos->first())
                            <div class="col-4">
                                <div class="footer-gallery position-relative">
                                    <img src="{{ asset('storage/' . $galery->photos->first()->isi_foto) }}" 
                                         class="img-fluid w-100" 
                                         alt="{{ $galery->photos->first()->judul_foto }}"
                                         style="height: 80px; object-fit: cover;">
                                    
                                    <div class="footer-search-icon">
                                        <a href="{{ asset('storage/' . $galery->photos->first()->isi_foto) }}" 
                                           data-lightbox="footer-gallery-{{ $galery->id }}" 
                                           class="my-auto">
                                            <i class="fas fa-search-plus text-white"></i>
                                        </a>
                                    </div>

                                    <!-- Hidden links untuk foto lainnya -->
                                    @foreach($galery->photos->skip(1) as $photo)
                                        <a href="{{ asset('storage/' . $photo->isi_foto) }}" 
                                           data-lightbox="footer-gallery-{{ $galery->id }}" 
                                           style="display: none;">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- Copyright Start -->
 <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-4 text-center text-md-start mb-md-0">
                    <span class="text-body"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Siti Nur Hanifah</a>, All right reserved.</span>
                </div>
                <div class="col-md-4 text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="https://web.facebook.com/people/SMK-NEGERI-4-KOTA-BOGOR/100054636630766/" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.youtube.com/channel/UC4M-6Oc1ZvECz00MlMa4v_A/videos?app=desktop" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" class="btn-hover-color btn-square text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn-hover-color btn-square text-white me-0"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


<!-- Footer End --> 