@extends('layouts.app', ['title' => 'Profile Sekolah - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-200 via-gray-400 to-teal-500 text-gray-800">
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center mb-4">
            <button class="text-white bg-gray-600 px-4 py-2 rounded-md shadow-sm">
                <a href="{{ route('admin.profile_sekolah.create') }}">TAMBAH PROFILE SEKOLAH</a>
            </button>
        </div>

        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-600 text-white">
                        <tr>
                            <th class="w-1/3 px-6 py-3 text-left text-lg font-medium text-white uppercase tracking-wider">JUDUL</th>
                            <th class="w-2/3 px-6 py-3 text-left text-lg font-medium text-white uppercase tracking-wider">ISI</th>
                            <th class="w-1/6 px-6 py-3 text-center text-lg font-medium text-white uppercase tracking-wider">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($profiles as $profile)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-medium text-gray-900">{{ $profile->judul }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">{{ Str::limit($profile->isi, 50) }}</div>
                            </td>
                            <td class="px-10 py-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.profile_sekolah.show', $profile->id) }}" class="bg-blue-500 px-4 py-2 rounded shadow-sm text-sm text-white focus:outline-none">SHOW</a>
                                    <a href="{{ route('admin.profile_sekolah.edit', $profile->id) }}" class="bg-gray-500 px-4 py-2 rounded shadow-sm text-sm text-white focus:outline-none">EDIT</a>
                                    <button onClick="destroy(this.id)" id="{{ $profile->id }}" class="bg-red-600 px-4 py-2 rounded shadow-sm text-xs text-white focus:outline-none">HAPUS</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-red-500">Data Belum Tersedia!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($profiles->hasPages())
                <div class="bg-white p-3">
                    {{ $profiles->links('vendor.pagination.tailwind') }}
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
            text: "INGIN MENGHAPUS USER INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, HAPUS!',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('admin/profile_sekolah/${id}') }}`, {
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
                        Swal.fire('GAGAL!', 'Terjadi kesalahan saat menghapus user!', 'error');
                    });
            }
        });
    }
</script>

@endsection