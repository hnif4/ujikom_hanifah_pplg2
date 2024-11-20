@extends('layouts.auth', ['title' => 'Forgot Password - Admin'])

@section('content')
@vite(['resources/js/app.js', 'resources/css/app.css'])

<div class="flex justify-center items-center h-screen bg-gradient-to-br from-gray-200 via-gray-400 to-teal-500 text-gray-800">
    <div class="p-8 max-w-sm w-full bg-white shadow-lg rounded-lg">
        <div class="flex justify-center mb-6">
            <h2 class="text-gray-800 font-bold text-2xl">RESET PASSWORD</h2>
        </div>
        
        @if (session('status'))
        <div class="bg-green-500 p-3 rounded-md shadow-sm mb-4">
            {{ session('status') }}
        </div>
        @endif
        
        <form class="mt-4" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-1" for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="form-input mt-1 block w-full border-gray-300 rounded-md focus:ring focus:ring-teal-200 focus:border-teal-500"
                    placeholder="Alamat Email" required>
                @error('email')
                <div class="inline-flex max-w-sm w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                    <div class="px-4 py-2">
                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                    </div>
                </div>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit"
                class="w-full py-2 px-4 bg-teal-600 hover:bg-teal-700 text-white rounded-md focus:outline-none">
                    SEND PASSWORD RESET LINK
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
