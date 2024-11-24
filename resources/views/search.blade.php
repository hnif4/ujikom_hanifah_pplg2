@extends('layouts.frontend')

@section('content')
<div class="container mx-auto py-10">
    <div class="flex flex-col items-center">
        <!-- Header Pencarian -->
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold mb-2">Hasil Pencarian: "{{ $keyword }}"</h2>
            <p class="text-gray-600">Ditemukan {{ $posts->total() }} hasil</p>
        </div>

        <!-- Jika Tidak Ada Hasil -->
        @if($posts->isEmpty())
        <div class="flex flex-col items-center justify-center h-64 text-center">
            <div class="bg-blue-100 text-blue-600 px-4 py-3 rounded-lg shadow-md">
                <i class="fas fa-info-circle mr-2"></i>
                Tidak ditemukan hasil untuk pencarian "{{ $keyword }}"
            </div>
        </div>
        @else
        <!-- Daftar Post -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $post->image) }}" 
                     alt="{{ $post->judul }}" 
                     class="h-48 w-full object-cover">
                <div class="p-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-semibold text-white bg-{{ $post->category_id == 1 ? 'blue-500' : 'green-500' }} py-1 px-2 rounded">
                            {{ $post->category_id == 1 ? 'Informasi' : 'Agenda' }}
                        </span>
                        <small class="text-gray-500">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ \Carbon\Carbon::parse($post->tanggal_posts)->format('d M Y') }}
                        </small>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">{{ $post->judul }}</h4>
                    @if($post->category_id == 2 && $post->lokasi)
                    <p class="text-sm text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
                        {{ $post->lokasi }}
                    </p>
                    @endif
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->isi, 200) }}</p>
                    <a href="{{ $post->category_id == 1 ? route('informasi.show', $post) : route('agenda.show', $post) }}" 
                       class="inline-block text-sm font-semibold text-blue-600 hover:text-blue-800">
                        {{ $post->category_id == 1 ? 'Baca Selengkapnya' : 'Lihat Detail Agenda' }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-8">
            {{ $posts->appends(['keyword' => $keyword])->links('vendor.pagination.tailwind') }}
        </div>
        @endif
    </div>
</div>
@endsection
