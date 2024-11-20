@extends('layouts.app', ['title' => 'Posts - Admin'])

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-200 via-gray-400 to-teal-500 text-gray-800">
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center">
            <button class="text-white focus:outline-none bg-gray-700 px-4 py-2 shadow-base rounded-md">
                <a href="{{ route('admin.posts.create') }}">TAMBAH POSTS</a>
            </button>
            <form action="{{ route('admin.posts.index') }}" method="GET" class="ml-4 flex items-center">
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

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-white uppercase tracking-wider">GAMBAR</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-white uppercase tracking-wider">JUDUL POSTS</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-white uppercase tracking-wider">ISI POSTS</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-white uppercase tracking-wider">TANGGAL POSTS</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-white uppercase tracking-wider">STATUS</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-white uppercase tracking-wider">KATEGORI</th>
                            <th class="px-4 py-2 text-center text-sm font-medium text-white uppercase tracking-wider">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($posts as $post)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 flex justify-center">
                                @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->judul }}" class="max-w-xs h-auto">
                                @else
                                <span>Tidak Ada Gambar</span>
                                @endif
                            </td>

                            <td class="px-4 py-2 whitespace-normal">
                                <div class="text-sm font-medium text-gray-900">{{ $post->judul }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-normal">
                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($post->isi, 100) }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $post->tanggal_posts }}</div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $post->status == 'aktif' ? 'Aktif' : 'Tidak Aktif' }}
                                </div>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $post->category->nama }}</div>
                            </td>


                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.posts.show', $post->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow-md focus:outline-none text-xs">SHOW</a>
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="bg-[#697565] px-3 py-1 rounded shadow-sm text-xs text-white focus:outline-none">EDIT</a>
                                    <button onClick="destroy(this.id)" id="{{ $post->id }}" class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded shadow-sm text-xs text-white focus:outline-none">HAPUS</button>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data Belum Tersedia!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 p-4">
            {{ $posts->links() }}
        </div>
    </div>
</main>

<script>
    function destroy(id) {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'APAKAH KAMU YAKIN?',
            text: "INGIN MENGHAPUS POST INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('admin/posts/${id}') }}`, {
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
                        Swal.fire('GAGAL!', 'Terjadi kesalahan saat menghapus post!', 'error');
                    });
            }
        });
    }
</script>
@endsection
