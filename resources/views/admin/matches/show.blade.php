@extends('layouts.admin')

@section('title', 'Detail Pertandingan')

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg tech-border p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div class="flex items-center">
                <div class="bg-gray-900 p-2 rounded-md mr-3 border border-gray-700">
                    <i class="fas fa-futbol text-cyan-500"></i>
                </div>
                <h1 class="text-2xl font-bold text-white">{{ $match->title }}</h1>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.matches.edit', $match) }}" 
                   class="bg-gray-700 hover:bg-gray-600 text-amber-400 font-medium py-2 px-4 rounded border border-gray-600 transition-colors flex items-center">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('admin.matches.destroy', $match) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-gray-700 hover:bg-gray-600 text-red-400 font-medium py-2 px-4 rounded border border-gray-600 transition-colors flex items-center"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus pertandingan ini?')">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <div class="bg-gray-900 rounded-lg tech-border p-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-gray-800 p-2 rounded-md mr-3 border border-gray-700">
                            <i class="fas fa-info-circle text-cyan-500"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-white">Detail Pertandingan</h2>
                    </div>
                    
                    <div class="space-y-3 divide-y divide-gray-700">
                        <div class="flex justify-between py-2">
                            <span class="text-gray-400">ID:</span>
                            <span class="text-white font-medium">{{ $match->id }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-400">Judul:</span>
                            <span class="text-white">{{ $match->title }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-400">Tim:</span>
                            <span class="text-white">{{ $match->teams }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-400">Tanggal:</span>
                            <span class="text-white">
                                <i class="far fa-calendar-alt text-cyan-500 mr-2"></i>
                                {{ $match->match_date->format('d M Y, H:i') }}
                            </span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-400">Venue:</span>
                            <span class="text-white">
                                <i class="fas fa-map-marker-alt text-cyan-500 mr-2"></i>
                                {{ $match->venue }}
                            </span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-400">Sisa Kursi:</span>
                            <span class="text-cyan-400 font-bold">{{ $match->available_seats }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-400">Harga Tiket:</span>
                            <span class="text-cyan-400 font-bold">Rp {{ number_format($match->ticket_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-400">Dibuat pada:</span>
                            <span class="text-white">{{ $match->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                @if($match->description)
                    <div class="bg-gray-900 rounded-lg tech-border p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-gray-800 p-2 rounded-md mr-3 border border-gray-700">
                                <i class="fas fa-align-left text-cyan-500"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-white">Deskripsi</h3>
                        </div>
                        <p class="text-gray-300">{{ $match->description }}</p>
                    </div>
                @else
                    <div class="bg-gray-900 rounded-lg tech-border p-6 h-full flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-info-circle text-cyan-500 text-4xl mb-4"></i>
                            <p class="text-gray-400">Pertandingan ini tidak memiliki deskripsi tambahan.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="text-center mt-6 mb-8">
        <a href="{{ route('admin.matches.index') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors flex items-center justify-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke daftar pertandingan
        </a>
    </div>
    
    <style>
    .tech-border {
        box-shadow: 0 0 5px rgba(6, 182, 212, 0.2);
    }
    </style>
@endsection