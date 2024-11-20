@extends('layouts.frontend')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Agenda Sekolah</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($agendaPosts as $agenda)
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                <div class="p-6">
                    <!-- Tanggal Agenda -->
                    <div class="text-center mb-4">
                        <div class="text-4xl font-bold text-primary">
                            {{ \Carbon\Carbon::parse($agenda->tanggal_posts)->format('d') }}
                        </div>
                        <div class="text-lg font-semibold text-gray-700">
                            {{ \Carbon\Carbon::parse($agenda->tanggal_posts)->format('F Y') }}
                        </div>
                    </div>
                    <!-- Judul Agenda -->
                    <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">{{ $agenda->judul }}</h3>
                    <!-- Tombol Detail -->
                    <div class="text-center">
                        <a href="{{ route('agenda.show', $agenda) }}" 
                           class="bg-primary text-white px-4 py-2 rounded-lg text-sm hover:bg-secondary transition-colors duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $agendaPosts->links() }}
        </div>
    </div>
</section>
@endsection
