@extends('layouts.app', ['title' => 'Manajemen - Admin'])

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-200 via-gray-400 to-teal-500 text-gray-800">
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center">
            <button class="text-white focus:outline-none bg-gray-700 px-4 py-2 shadow-base rounded-md">
                <a href="{{ route('admin.users.create') }}">TAMBAH PETUGAS</a>
            </button>
            <form action="{{ route('admin.users.index') }}" method="GET" class="ml-4 flex items-center">
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
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="w-1/4 px-6 py-3 text-left text-lg font-medium text-white uppercase tracking-wider">ID</th>
                            <th class="w-1/4 px-6 py-3 text-left text-lg font-medium text-white uppercase tracking-wider">NAMA</th>
                            <th class="w-1/4 px-6 py-3 text-left text-lg font-medium text-white uppercase tracking-wider">EMAIL</th>
                            <th class="w-1/4 px-6 py-3 text-left text-lg font-medium text-white uppercase tracking-wider">STATUS</th>
                            <th class="w-1/4 px-6 py-3 text-center text-lg font-medium text-white uppercase tracking-wider">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-medium text-gray-900">{{ $user->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-normal">
                                <div class="text-lg font-medium text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-normal">
                                <div class="text-lg font-medium text-gray-900">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-lg font-medium text-gray-900">
                                    {{ $user->status == 'aktif' ? 'Aktif' : 'Tidak Aktif' }}
                                </div>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-[#697565] px-4 py-2 rounded shadow-sm text-sm text-white focus:outline-none">EDIT</a>
                                    <button onClick="destroy(this.id)" id="{{ $user->id }}" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded shadow-sm text-white focus:outline-none">HAPUS</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Data Petugas Belum Tersedia!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 p-4">
            {{ $users->links() }}
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
                fetch(`{{ url('admin/users/${id}') }}`, {
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