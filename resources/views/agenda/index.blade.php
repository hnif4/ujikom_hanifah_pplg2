@extends('layouts.frontend')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Title Section -->
        <div class="text-center mb-12">
            <h5 class="text-primary-600 font-semibold text-sm tracking-wider uppercase mb-2">Agenda Sekolah</h5>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Upcoming Events</h1>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($agendaPosts as $agenda)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden group hover:shadow-lg transition duration-300">
                <div class="p-6">
                    <!-- Tanggal Agenda -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-2">
                            <div class="bg-primary-100 text-primary-600 rounded-lg p-3">
                                <i class="far fa-calendar-alt text-2xl"></i>
                            </div>
                            <div>
                                <div class="text-lg font-bold text-gray-900">
                                    {{ \Carbon\Carbon::parse($agenda->tanggal_posts)->format('d M') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($agenda->tanggal_posts)->format('Y') }}
                                </div>
                            </div>
                        </div>
                        @php
                            $agendaDate = \Carbon\Carbon::parse($agenda->tanggal_posts)->startOfDay();
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
                        <span class="px-3 py-1 rounded-full text-sm {{ $isPast ? 'bg-gray-100 text-gray-600' : 'bg-primary-100 text-primary-600' }}">
                            {{ $timeStatus }}
                        </span>
                    </div>

                    <!-- Judul & Lokasi -->
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 min-h-[3.5rem]">{{ $agenda->judul }}</h3>
                    
                    @if($agenda->lokasi)
                    <div class="flex items-center text-gray-500 mb-4 text-sm">
                        <i class="fas fa-map-marker-alt mr-2 text-primary-500"></i>
                        {{ $agenda->lokasi }}
                    </div>
                    @endif

                    <p class="text-gray-600 mb-6 text-sm line-clamp-3">{{ Str::limit($agenda->isi, 120) }}</p>

                    <!-- Tombol Detail -->
                    <a href="{{ route('agenda.show', $agenda) }}" 
                       class="inline-flex items-center text-primary-600 hover:text-primary-700 transition-colors duration-300 text-sm group">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $agendaPosts->links() }}
        </div>
    </div>
</section>
@endsection
