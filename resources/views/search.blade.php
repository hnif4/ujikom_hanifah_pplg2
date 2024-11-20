@extends('layouts.frontend')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-12">
            <div class="mb-4 text-center">
                <h2 class="mb-3">Hasil Pencarian: "{{ $keyword }}"</h2>
                <p class="text-muted">Ditemukan {{ $posts->total() }} hasil</p>
            </div>

            @if($posts->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    Tidak ditemukan hasil untuk pencarian "{{ $keyword }}"
                </div>
            @endif

            @foreach($posts as $post)
            <div class="card mb-4 shadow-sm border-0">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             class="img-fluid rounded-start h-100" 
                             style="object-fit: cover;" 
                             alt="{{ $post->judul }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-{{ $post->category_id == 1 ? 'primary' : 'success' }}">
                                    {{ $post->category_id == 1 ? 'Informasi' : 'Agenda' }}
                                </span>
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ \Carbon\Carbon::parse($post->tanggal_posts)->format('d M Y') }}
                                </small>
                            </div>
                            
                            <h4 class="card-title mb-2">{{ $post->judul }}</h4>
                            
                            @if($post->category_id == 2 && $post->lokasi)
                            <p class="mb-2">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                {{ $post->lokasi }}
                            </p>
                            @endif
                            
                            <p class="card-text text-secondary">{{ Str::limit($post->isi, 200) }}</p>
                            
                            <a href="{{ $post->category_id == 1 ? route('informasi.show', $post) : route('agenda.show', $post) }}" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-arrow-right me-2"></i>
                                {{ $post->category_id == 1 ? 'Baca Selengkapnya' : 'Lihat Detail Agenda' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->appends(['keyword' => $keyword])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
