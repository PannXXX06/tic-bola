@extends('layouts.admin')

@section('title', 'Daftar Pertandingan')

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 tech-border">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
            <div class="flex items-center">
                <div class="bg-gray-900 p-2 rounded-md mr-3 border border-gray-700">
                    <i class="fas fa-futbol text-cyan-500"></i>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-white">Daftar Pertandingan</h1>
            </div>
            <a href="{{ route('admin.matches.create') }}" 
               class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium py-2 px-4 rounded tech-border transition duration-300 flex items-center justify-center sm:justify-start">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Pertandingan
            </a>
        </div>
        
        <div class="mb-4 bg-gray-900 rounded-lg p-4 tech-border md:hidden">
            <div class="flex flex-col gap-3">
                <div class="relative">
                    <input type="text" placeholder="Cari pertandingan..." class="w-full bg-gray-800 border border-gray-700 rounded-lg pl-10 py-2 text-white placeholder-gray-500 focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <div class="flex gap-2">
                    <select class="bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-white flex-grow focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors">
                        <option value="">Semua Pertandingan</option>
                        <option value="upcoming">Mendatang</option>
                        <option value="past">Selesai</option>
                    </select>
                    <button class="bg-cyan-500 hover:bg-cyan-600 text-white rounded-lg px-3 py-2 transition-colors flex items-center justify-center">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden md:block overflow-x-auto bg-gray-900 rounded-lg tech-border">
            <table class="min-w-full">
                <thead class="bg-gray-800 border-b border-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">ID</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Judul</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Tim</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Venue</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Sisa Kursi</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Harga</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse ($matches as $match)
                        <tr class="hover:bg-gray-800/70 transition-colors">
                            <td class="py-3 px-4 text-gray-300">{{ $match->id }}</td>
                            <td class="py-3 px-4 text-white font-medium">{{ $match->title }}</td>
                            <td class="py-3 px-4 text-gray-300">{{ $match->teams }}</td>
                            <td class="py-3 px-4 text-gray-300">
                                <div class="flex items-center">
                                    <i class="far fa-calendar-alt text-cyan-500 mr-2"></i>
                                    {{ $match->match_date->format('d/m/Y H:i') }}
                                </div>
                            </td>
                            <td class="py-3 px-4 text-gray-300">
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt text-cyan-500 mr-2"></i>
                                    {{ $match->venue }}
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="text-cyan-400 font-medium">{{ $match->available_seats }}</span>
                            </td>
                            <td class="py-3 px-4 text-cyan-400 font-medium">
                                Rp {{ number_format($match->ticket_price, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-4 flex space-x-2">
                                <a href="{{ route('admin.matches.show', $match) }}" 
                                   class="bg-gray-700 hover:bg-gray-600 text-cyan-400 py-1 px-3 rounded text-sm transition-colors border border-gray-600 flex items-center">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                                <a href="{{ route('admin.matches.edit', $match) }}" 
                                   class="bg-gray-700 hover:bg-gray-600 text-amber-400 py-1 px-3 rounded text-sm transition-colors border border-gray-600 flex items-center">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.matches.destroy', $match) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-gray-700 hover:bg-gray-600 text-red-400 py-1 px-3 rounded text-sm transition-colors border border-gray-600 flex items-center"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pertandingan ini?')">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 px-4 text-center text-gray-400">
                                <i class="fas fa-info-circle text-cyan-500 text-2xl mb-2"></i>
                                <p>Belum ada pertandingan yang ditambahkan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="md:hidden space-y-4">
            @forelse ($matches as $match)
                <div class="bg-gray-900 rounded-lg overflow-hidden tech-border border border-gray-700 hover:border-cyan-500/30 transition-all duration-200">
                    <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-3 border-b border-gray-700 flex justify-between items-center">
                        <h3 class="font-medium text-white flex items-center">
                            <span class="bg-gray-700 text-gray-300 rounded-md px-2 py-1 text-xs mr-2 border border-gray-600">#{{ $match->id }}</span>
                            {{ $match->title }}
                        </h3>
                        <div class="flex gap-1">
                            <a href="{{ route('admin.matches.show', $match) }}" class="bg-gray-800 text-cyan-400 p-1.5 rounded-md hover:bg-gray-700 transition-colors">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.matches.edit', $match) }}" class="bg-gray-800 text-amber-400 p-1.5 rounded-md hover:bg-gray-700 transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div>
                                <div class="text-xs text-gray-500 uppercase mb-1 flex items-center">
                                    <i class="fas fa-users text-cyan-500 mr-1"></i> Tim
                                </div>
                                <div class="text-gray-300 truncate">{{ $match->teams }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 uppercase mb-1 flex items-center">
                                    <i class="fas fa-map-marker-alt text-cyan-500 mr-1"></i> Venue
                                </div>
                                <div class="text-gray-300 truncate">{{ $match->venue }}</div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-800 rounded-lg p-3 mb-4 border border-gray-700">
                            <div class="text-xs text-gray-500 uppercase mb-1 flex items-center justify-center">
                                <i class="far fa-calendar-alt text-cyan-500 mr-1"></i> Jadwal Pertandingan
                            </div>
                            <div class="flex justify-center items-center text-white">
                                <span class="text-gray-300">{{ $match->match_date->format('d M Y') }}</span>
                                <span class="mx-2 text-gray-600">|</span>
                                <span class="text-cyan-400 font-medium">{{ $match->match_date->format('H:i') }} WIB</span>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="bg-gray-800 p-3 rounded-lg border border-gray-700 text-center">
                                <div class="text-xs text-gray-500 uppercase mb-1">Sisa Kursi</div>
                                <div class="text-cyan-400 font-bold text-lg">{{ $match->available_seats }}</div>
                            </div>
                            <div class="bg-gray-800 p-3 rounded-lg border border-gray-700 text-center">
                                <div class="text-xs text-gray-500 uppercase mb-1">Harga</div>
                                <div class="text-cyan-400 font-bold text-lg">Rp {{ number_format($match->ticket_price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between">
                            <a href="{{ route('admin.matches.show', $match) }}" 
                               class="flex-1 mr-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 text-cyan-400 font-medium py-2 px-3 rounded text-center transition-colors">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                            <form action="{{ route('admin.matches.destroy', $match) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-gray-800 hover:bg-gray-700 border border-gray-700 text-red-400 font-medium py-2 px-3 rounded transition-colors"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pertandingan ini?')">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-gray-900 rounded-lg p-8 text-center border border-gray-700">
                    <div class="w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-700">
                        <i class="fas fa-calendar-times text-cyan-500 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-white mb-2">Belum Ada Pertandingan</h3>
                    <p class="text-gray-400 mb-4">Belum ada pertandingan yang ditambahkan ke sistem.</p>
                    <a href="{{ route('admin.matches.create') }}" 
                       class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-medium py-2 px-4 rounded inline-flex items-center">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Pertandingan
                    </a>
                </div>
            @endforelse
        </div>
        
        <div class="mt-6 px-2">
            {{ $matches->links() }}
        </div>
    </div>
    
    <style>
    .tech-border {
        box-shadow: 0 0 5px rgba(6, 182, 212, 0.2);
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
        flex-wrap: wrap;
    }
    .pagination > nav {
        display: inline-flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .pagination .relative {
        color: #e5e5e5;
    }
    .pagination .relative span.cursor-default {
        background-color: #06b6d4;
        color: #1a1a1a;
    }
    .pagination span, .pagination button, .pagination a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2rem;
        min-height: 2rem;
        margin: 0.25rem;
        padding: 0.5rem;
        border-radius: 0.25rem;
        background-color: #1f2937;
        border: 1px solid #374151;
        color: #e5e5e5;
        font-size: 0.875rem;
        transition: all 0.2s;
    }
    .pagination a:hover, .pagination button:hover {
        background-color: #374151;
        color: #06b6d4;
    }
    .pagination svg {
        width: 1rem;
        height: 1rem;
    }
    .pagination .text-gray-400 {
        color: #9ca3af;
    }
    
    @media (max-width: 640px) {
        .pagination span, .pagination button, .pagination a {
            min-width: 1.75rem;
            min-height: 1.75rem;
            margin: 0.125rem;
            padding: 0.25rem;
            font-size: 0.75rem;
        }
        .pagination svg {
            width: 0.75rem;
            height: 0.75rem;
        }
    }
    </style>
@endsection