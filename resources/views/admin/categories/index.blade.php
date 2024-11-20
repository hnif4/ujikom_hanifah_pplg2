@extends('layouts.app', ['title' => 'Kategori - Admin'])

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-200 via-gray-400 to-teal-500 text-gray-800">
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center mb-4">
            <button class="text-white focus:outline-none bg-gray-700 px-4 py-2 shadow-base rounded-md">
                <a href="{{ route('admin.categories.create') }}">TAMBAH</a>
            </button>
            <form action="{{ route('admin.categories.index') }}" method="GET" class="ml-4 flex items-center">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                            <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <input class="form-input w-full max-w-xs pl-10 pr-4 py-2 rounded-lg border-gray-300 focus:ring-gray-600" type="text" name="q" value="{{ request()->query('q') }}" placeholder="Search">
                </div>
            </form>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="w-1/3 px-6 py-3 text-left text-lg font-medium text-white uppercase tracking-wider">Nama Kategori</th>
                        <th class="w-1/3 px-6 py-3 text-left text-lg font-medium text-white uppercase tracking-wider">Deskripsi</th>
                        <th class="w-1/3 px-6 py-3 text-center text-lg font-medium text-white uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-base font-medium text-gray-900">{{ $category->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-base font-medium text-gray-900">{{ $category->deskripsi }}</div>
                        </td>
                        <td class="px-10 py-2 text-center">
                            <a href="{{ route('admin.categories.show', $category->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow-md focus:outline-none">SHOW</a>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-[#697565] px-4 py-2 rounded shadow-sm text-sm text-white focus:outline-none">EDIT</a>
                            <button onClick="destroy(this.id)" id="{{ $category->id }}" class="bg-red-600 px-4 py-2 rounded shadow-sm text-xs text-white focus:outline-none">HAPUS</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">Data kategori belum tersedia!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($categories->hasPages())
            <div class="bg-gray-50 px-4 py-3 border-t border-gray-200">
                {{ $categories->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>
    </div>
</main>


<script>
    function destroy(id) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'APAKAH KAMU YAKIN?',
            text: "INGIN MENGHAPUS DATA INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('admin/categories/${id}') }}`, {
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
                        Swal.fire('GAGAL!', 'Terjadi kesalahan saat menghapus data!', 'error');
                    });
            }
        });
    }
</script>
@endsection