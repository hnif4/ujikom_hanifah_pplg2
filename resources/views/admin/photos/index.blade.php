@extends('layouts.app', ['title' => 'Photo - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-200 via-gray-400 to-teal-500 text-gray-800">
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center">
            <button class="text-white bg-gray-700 px-4 py-2 rounded-md shadow-sm">
                <a href="{{ route('admin.photos.create') }}">TAMBAH FOTO</a>
            </button>
        </div>

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="w-1/3 px-6 py-3 text-left text-lg font-medium text-white uppercase tracking-wider">FOTO</th>
                            <th class="w-1/3 px-6 py-3 text-left text-lg font-medium text-white uppercase tracking-wider">JUDUL FOTO</th>
                            <th class="w-1/3 px-6 py-3 text-center text-lg font-medium text-white uppercase tracking-wider">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($photos as $photo)
                        <tr class="hover:bg-gray-100">
                            <td class="px-16 py-2">
                                <img src="{{ asset('storage/' . $photo->isi_foto) }}" alt="{{ $photo->judul_foto }}" class="w-32 h-32 object-cover">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-medium text-gray-800">{{ $photo->judul_foto }}</div>
                            </td>
                            <td class="px-10 py-2 text-center">
                                <a href="{{ route('admin.photos.show', $photo->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow-md focus:outline-none">SHOW</a>
                                <a href="{{ route('admin.photos.edit', $photo->id) }}" class="bg-gray-500 px-4 py-2 rounded shadow-sm text-sm text-white focus:outline-none">EDIT</a>
                                <button onClick="destroy(this.id)" id="{{ $photo->id }}" class="bg-red-600 px-4 py-2 rounded shadow-sm text-xs text-white focus:outline-none">HAPUS</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-600">Data Foto Belum Tersedia!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($photos->hasPages())
                <div class="bg-white p-3">
                    {{ $photos->links('vendor.pagination.tailwind') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</main>

<script>
    function destroy(id) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'APAKAH KAMU YAKIN?',
            text: "INGIN MENGHAPUS FOTO INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('admin/photos/${id}') }}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json',
                        }
                    })

                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            Swal.fire('BERHASIL!', data.message, 'success').then(() => location.reload());
                        } else {
                            Swal.fire('GAGAL!', data.message || 'DATA GAGAL DIHAPUS!', 'error');
                        }
                    })
                    .catch(() => {
                        Swal.fire('GAGAL!', 'Terjadi kesalahan saat menghapus foto!', 'error');
                    });
            }
        });
    }
</script>
@endsection