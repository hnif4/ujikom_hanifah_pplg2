@extends('layouts.app', ['title' => 'Profile - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-gray-200 via-gray-400 to-teal-500 text-gray-800">
    <div class="container mx-auto px-6 py-8">
        @if (session('status'))
        <div class="bg-green-500 p-3 rounded-md shadow-sm mt-3">
            @if (session('status') == 'profile-information-updated')
            Profile has been updated.
            @endif
            @if (session('status') == 'password-updated')
            Password has been updated.
            @endif
        </div>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
            <div>
                <div class="p-6 bg-white rounded-md shadow-md">
                    <!-- Avatar -->
                    <div class="flex justify-center mb-4">
                        <img src="{{ $user->avatar }}" class="rounded-full w-32 h-32 object-cover" alt="User Avatar">
                    </div>

                    <h2 class="text-lg text-gray-700 font-semibold capitalize">EDIT PROFILE</h2>
                    <hr class="mt-4">
                    <form action="{{ route('user-profile-information.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block">
                                <span class="text-gray-700 text-sm">Nama Lengkap</span>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="form-input mt-1 block w-full rounded-md" placeholder="Nama Lengkap">
                                @error('name')
                                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                                @enderror
                            </label>
                        </div>

                        <!-- Alamat Email -->
                        <div class="mt-4">
                            <label class="block">
                                <span class="text-gray-700 text-sm">Alamat Email</span>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-input mt-1 block w-full rounded-md" placeholder="Alamat Email">
                                @error('email')
                                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                                @enderror
                            </label>
                        </div>

                        <!-- Upload Avatar -->
                        <div class="mt-4">
                            <label class="block">
                                <span class="text-gray-700 text-sm">Upload Avatar</span>
                                <input type="file" name="avatar" class="form-input mt-1 block w-full rounded-md">
                                @error('avatar')
                                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                                @enderror
                            </label>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-start mt-4">
                            <button type="submit"
                                class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                                UPDATE PROFILE
                            </button>

                        </div>
                    </form>
                </div>

                <div class="mt-6 p-6 bg-white rounded-md shadow-md">
                    <h2 class="text-lg text-gray-700 font-semibold capitalize">UPDATE PASSWORD</h2>
                    <hr class="mt-4">
                    <form class="mt-4" action="{{ route('user-password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Password Lama -->
                        <div>
                            <label class="block">
                                <span class="text-gray-700 text-sm">Password Lama</span>
                                <input type="password" name="current_password"
                                    class="form-input mt-1 block w-full rounded-md" placeholder="Password Lama">
                            </label>
                        </div>

                        <!-- Password Baru -->
                        <div class="mt-4">
                            <label class="block">
                                <span class="text-gray-700 text-sm">Password Baru</span>
                                <input type="password" name="password"
                                    class="form-input mt-1 block w-full rounded-md" placeholder="Password Baru">
                            </label>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mt-4">
                            <label class="block">
                                <span class="text-gray-700 text-sm">Konfirmasi Password Baru</span>
                                <input type="password" name="password_confirmation"
                                    class="form-input mt-1 block w-full rounded-md" placeholder="Konfirmasi Password Baru">
                            </label>
                        </div>

                        <!-- Tombol Update Password -->
                        <div class="flex justify-start mt-4">
                            <button type="submit"
                                class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                                UPDATE PASSWORD
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
</main>
@endsection