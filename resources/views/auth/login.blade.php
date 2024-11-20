@extends('layouts.auth', ['title' => 'Login - Admin'])

@section('content')
@vite(['resources/js/app.js', 'resources/css/app.css'])

<div class="flex justify-center items-center h-screen bg-gradient-to-br from-gray-200 via-gray-400 to-teal-500 text-gray-800">
    <div class="p-8 max-w-sm w-full bg-white shadow-lg rounded-lg">
        <div class="flex justify-center mb-6">
            <h2 class="text-gray-800 font-bold text-3xl">LOGIN</h2>
        </div>
        
        @if (session('status'))
        <div class="bg-green-500 p-3 rounded-md shadow-sm mb-4">
            {{ session('status') }}
        </div>
        @endif
        
        <form class="mt-4" action="{{ route('login') }}" method="POST">
            @csrf
            
            <label class="block mb-2" for="email">
                <span class="text-gray-700 text-sm font-semibold">EMAIL</span>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-input mt-1 block w-full rounded-md border border-gray-300 focus:ring focus:ring-teal-200 focus:border-teal-500"
                    placeholder="Alamat Email" required>
                @error('email')
                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
                @enderror
            </label>
            
            <label class="block mb-2" for="password">
                <span class="text-gray-700 text-sm font-semibold">PASSWORD</span>
                <input type="password" name="password" class="form-input mt-1 block w-full rounded-md border border-gray-300 focus:ring focus:ring-teal-200 focus:border-teal-500"
                    placeholder="Password" required>
                @error('password')
                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
                @enderror
            </label>
            
            <div class="flex justify-between items-center mt-4">
                <div class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-teal-600">
                    <span class="ml-2 text-gray-600 text-sm">Ingatkan Saya</span>
                </div>
                <div>
                    <a class="text-sm text-teal-600 hover:underline" href="/forgot-password">Lupa Password?</a>
                </div>
            </div>
            
            <div class="mt-6">
                <button type="submit" class="w-full py-2 px-4 bg-teal-600 hover:bg-teal-700 text-white rounded-md focus:outline-none">
                    LOGIN
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
