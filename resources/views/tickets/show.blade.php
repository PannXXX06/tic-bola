@extends('layouts.app')

@section('title', $match->title)

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden tech-border mb-8">
        <div class="bg-gradient-to-r from-gray-700 to-gray-800 p-6 border-b border-gray-700">
            <div class="flex items-center mb-2">
                <div class="bg-gray-900 p-2 rounded-md mr-3 border border-gray-700">
                    <i class="fas fa-futbol text-cyan-500"></i>
                </div>
                <h1 class="text-3xl font-bold text-white">{{ $match->title }}</h1>
            </div>
            <p class="text-gray-400 ml-12">{{ $match->teams }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
            <div class="bg-gray-900 rounded-lg p-6 tech-border">
                <h2 class="text-xl font-semibold mb-4 text-cyan-400 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> Detail Pertandingan
                </h2>
                
                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-gray-800 rounded-md flex items-center justify-center mr-3 border border-gray-700">
                            <i class="fas fa-users text-cyan-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Tim</p>
                            <p class="text-white">{{ $match->teams }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-gray-800 rounded-md flex items-center justify-center mr-3 border border-gray-700">
                            <i class="fas fa-calendar-alt text-cyan-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Tanggal & Waktu</p>
                            <p class="text-white">{{ $match->match_date->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-gray-800 rounded-md flex items-center justify-center mr-3 border border-gray-700">
                            <i class="fas fa-map-marker-alt text-cyan-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Venue</p>
                            <p class="text-white">{{ $match->venue }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-gray-800 rounded-md flex items-center justify-center mr-3 border border-gray-700">
                            <i class="fas fa-chair text-cyan-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Sisa Kursi</p>
                            <p class="text-cyan-400 font-bold text-xl">{{ $match->available_seats }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-gray-800 rounded-md flex items-center justify-center mr-3 border border-gray-700">
                            <i class="fas fa-tag text-cyan-500"></i>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Harga Tiket</p>
                            <p class="text-cyan-400 font-bold text-xl">Rp {{ number_format($match->ticket_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                
                @if($match->description)
                    <div class="mt-6 pt-6 border-t border-gray-700">
                        <h2 class="text-xl font-semibold mb-3 text-cyan-400 flex items-center">
                            <i class="fas fa-align-left mr-2"></i> Deskripsi
                        </h2>
                        <p class="text-gray-300">{{ $match->description }}</p>
                    </div>
                @endif
            </div>
            
            <div>
                <div class="bg-gray-900 rounded-lg p-6 tech-border">
                    <h2 class="text-xl font-semibold mb-4 text-cyan-400 flex items-center">
                        <i class="fas fa-ticket-alt mr-2"></i> Form Pendaftaran Tiket
                    </h2>
                    
                    @if($match->available_seats > 0)
                        <form action="{{ route('tickets.store', $match) }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="name" class="block text-gray-300 font-medium mb-2">Nama</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                           class="w-full bg-gray-800 border border-gray-700 rounded pl-10 py-2.5 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                                           required>
                                </div>
                                @error('name')
                                    <p class="text-red-400 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="email" class="block text-gray-300 font-medium mb-2">Email</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                           class="w-full bg-gray-800 border border-gray-700 rounded pl-10 py-2.5 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                                           required>
                                </div>
                                @error('email')
                                    <p class="text-red-400 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="address" class="block text-gray-300 font-medium mb-2">Alamat</label>
                                <div class="relative">
                                    <span class="absolute top-3 left-3 text-gray-500 pointer-events-none">
                                        <i class="fas fa-home"></i>
                                    </span>
                                    <textarea name="address" id="address" rows="3" 
                                              class="w-full bg-gray-800 border border-gray-700 rounded pl-10 py-2.5 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                                              required>{{ old('address') }}</textarea>
                                </div>
                                @error('address')
                                    <p class="text-red-400 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="birth_date" class="block text-gray-300 font-medium mb-2">Tanggal Lahir</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-birthday-cake"></i>
                                    </span>
                                    <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" 
                                           class="w-full bg-gray-800 border border-gray-700 rounded pl-10 py-2.5 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                                           required>
                                </div>
                                @error('birth_date')
                                    <p class="text-red-400 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium py-3 px-4 rounded tech-border transition-colors flex items-center justify-center">
                                <i class="fas fa-ticket-alt mr-2"></i> Daftar Sekarang
                            </button>
                        </form>
                    @else
                        <div class="bg-gray-800 border-l-4 border-red-500 text-red-400 p-4 rounded flex items-start">
                            <i class="fas fa-exclamation-circle mt-1 mr-3 text-lg"></i>
                            <p>Maaf, tiket untuk pertandingan ini sudah habis!</p>
                        </div>
                    @endif
                </div>
                
                <div class="mt-4 p-4 bg-gray-900 rounded-lg tech-border flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Total tiket terjual</p>
                        <p class="text-xl font-bold text-cyan-400">
                            {{ $match->tickets()->count() }} <span class="text-sm text-gray-400">tiket</span>
                        </p>
                    </div>
                    <div class="h-10 w-px bg-gray-700 mx-4"></div>
                    <div>
                        <p class="text-gray-400 text-sm mb-1">Status tiket</p>
                        @if($match->available_seats > 20)
                            <p class="text-green-400 font-medium">Tersedia <i class="fas fa-check-circle ml-1"></i></p>
                        @elseif($match->available_seats > 0)
                            <p class="text-yellow-400 font-medium">Hampir habis <i class="fas fa-exclamation-circle ml-1"></i></p>
                        @else
                            <p class="text-red-400 font-medium">Habis <i class="fas fa-times-circle ml-1"></i></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-center mb-8">
        <a href="{{ route('home') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors flex items-center justify-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke daftar pertandingan
        </a>
    </div>
    
    <style>
    .tech-border {
        box-shadow: 0 0 5px rgba(6, 182, 212, 0.2);
    }
    
    input:focus, textarea:focus {
        box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.2);
        outline: none;
    }
    
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(0.8);
    }
    </style>
@endsection