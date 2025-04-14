@extends('layouts.admin')

@section('title', 'Edit Pertandingan')

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 tech-border">
        <div class="flex items-center mb-6">
            <div class="bg-gray-900 p-2 rounded-md mr-3 border border-gray-700">
                <i class="fas fa-edit text-cyan-500"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Edit Pertandingan</h1>
        </div>
        
        <form action="{{ route('admin.matches.update', $match) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-900 p-6 rounded-lg tech-border">
                    <h2 class="text-lg font-semibold text-cyan-400 mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i> Informasi Dasar
                    </h2>
                
                    <div class="mb-5">
                        <label for="title" class="block text-gray-300 font-medium mb-2">Judul Pertandingan</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                <i class="fas fa-trophy"></i>
                            </span>
                            <input type="text" name="title" id="title" value="{{ old('title', $match->title) }}" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded pl-10 py-2.5 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                                   required>
                        </div>
                        @error('title')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="teams" class="block text-gray-300 font-medium mb-2">Tim</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                <i class="fas fa-users"></i>
                            </span>
                            <input type="text" name="teams" id="teams" value="{{ old('teams', $match->teams) }}" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded pl-10 py-2.5 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                                   required>
                        </div>
                        @error('teams')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="match_date" class="block text-gray-300 font-medium mb-2">Tanggal & Waktu</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <input type="datetime-local" name="match_date" id="match_date" 
                                   value="{{ old('match_date', $match->match_date->format('Y-m-d\TH:i')) }}" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded pl-10 py-2.5 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                                   required>
                        </div>
                        @error('match_date')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="venue" class="block text-gray-300 font-medium mb-2">Venue</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <input type="text" name="venue" id="venue" value="{{ old('venue', $match->venue) }}" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded pl-10 py-2.5 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                                   required>
                        </div>
                        @error('venue')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
                
                <div class="bg-gray-900 p-6 rounded-lg tech-border">
                    <h2 class="text-lg font-semibold text-cyan-400 mb-4 flex items-center">
                        <i class="fas fa-ticket-alt mr-2"></i> Informasi Tiket
                    </h2>
                
                    <div class="mb-5">
                        <label for="available_seats" class="block text-gray-300 font-medium mb-2">Jumlah Kursi</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                <i class="fas fa-chair"></i>
                            </span>
                            <input type="number" name="available_seats" id="available_seats" 
                                   value="{{ old('available_seats', $match->available_seats) }}" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded pl-10 py-2.5 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                                   required min="1">
                        </div>
                        @error('available_seats')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="ticket_price" class="block text-gray-300 font-medium mb-2">Harga Tiket (Rp)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                <i class="fas fa-tag"></i>
                            </span>
                            <input type="number" name="ticket_price" id="ticket_price" 
                                   value="{{ old('ticket_price', $match->ticket_price) }}" 
                                   class="w-full bg-gray-800 border border-gray-700 rounded pl-10 py-2.5 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                                   required min="0" step="0.01">
                        </div>
                        @error('ticket_price')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label for="description" class="block text-gray-300 font-medium mb-2">Deskripsi</label>
                        <div class="relative">
                            <textarea name="description" id="description" rows="5" 
                                     class="w-full bg-gray-800 border border-gray-700 rounded py-2.5 px-3 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors">{{ old('description', $match->description) }}</textarea>
                        </div>
                        @error('description')
                            <p class="text-red-400 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.matches.index') }}" 
                   class="bg-gray-700 hover:bg-gray-600 text-gray-300 font-medium py-2.5 px-5 rounded border border-gray-600 transition-colors flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" 
                        class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium py-2.5 px-5 rounded tech-border transition-colors flex items-center">
                    <i class="fas fa-sync-alt mr-2"></i> Update Pertandingan
                </button>
            </div>
        </form>
    </div>
    
    <style>
    .tech-border {
        box-shadow: 0 0 5px rgba(6, 182, 212, 0.2);
    }
    
    input:focus, textarea:focus {
        box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.2);
        outline: none;
    }
    
    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        filter: invert(0.8);
    }
    </style>
@endsection