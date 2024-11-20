@extends('layouts.app', ['title' => 'Message - Admin'])

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
        <div class="container mx-auto px-6 py-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="bg-gray-700 p-4">
                    <h2 class="text-white text-xl">Detail Message</h2>
                </div>  
                <div class="p-6">
                    <h5 class="text-lg font-semibold">Nama Pengirim: {{ $message->name }}</h5>
                    <p class="mt-2 text-gray-600"><strong>Email:</strong> {{ $message->email }}</p>
                    <p class="mt-2 text-gray-600"><strong>Message:</strong> {{ $message->message }}</p>
                    <div class="mt-4">
                        <a href="{{ route('admin.message.index') }}" class="text-white focus:outline-none bg-gray-700 px-4 py-2 shadow-base rounded-md">Kembali ke Daftar Pesan</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
