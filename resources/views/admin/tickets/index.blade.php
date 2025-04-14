@extends('layouts.admin')

@section('title', 'Manajemen Tiket')

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 tech-border">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div class="flex items-center">
                <div class="bg-gray-900 p-2 rounded-md mr-3 border border-gray-700">
                    <i class="fas fa-ticket-alt text-cyan-500"></i>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-white">Manajemen Tiket</h1>
            </div>
        </div>
        
        <form action="{{ route('admin.tickets.index') }}" method="GET" class="mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow">
                    <div class="relative">
                        <input type="text" name="search" id="search" placeholder="Cari pertandingan, tim, atau venue..." value="{{ request('search') }}"
                               class="w-full bg-gray-900 border border-gray-700 rounded-lg pl-10 pr-4 py-3 text-white placeholder-gray-500 focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <i class="fas fa-search"></i>
                        </span>
                        @if(request('search'))
                            <a href="{{ route('admin.tickets.index') }}" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-cyan-500">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <select name="filter_date" class="bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors">
                        <option value="">Semua Tanggal</option>
                        <option value="today" {{ request('filter_date') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="this-week" {{ request('filter_date') == 'this-week' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="this-month" {{ request('filter_date') == 'this-month' ? 'selected' : '' }}>Bulan Ini</option>
                    </select>
                    <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-5 rounded-lg transition-colors flex items-center justify-center whitespace-nowrap">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                </div>
            </div>
        </form>
        
        @if(request('search') || request('filter_date'))
            <div class="bg-gray-900 p-4 rounded-lg mb-6 flex items-center justify-between">
                <div class="flex items-center text-gray-300">
                    <i class="fas fa-search text-cyan-500 mr-2"></i>
                    <span>
                        Hasil pencarian untuk: 
                        <strong class="text-white">{{ request('search') }}</strong>
                        @if(request('filter_date'))
                            <span class="mx-2">|</span>
                            <span>
                                Filter: 
                                <span class="bg-cyan-500/20 text-cyan-400 px-2 py-0.5 rounded text-xs">
                                    @if(request('filter_date') == 'today')
                                        Hari Ini
                                    @elseif(request('filter_date') == 'this-week')
                                        Minggu Ini
                                    @elseif(request('filter_date') == 'this-month')
                                        Bulan Ini
                                    @endif
                                </span>
                            </span>
                        @endif
                    </span>
                </div>
                <a href="{{ route('admin.tickets.index') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors text-sm flex items-center">
                    <i class="fas fa-times-circle mr-1"></i> Hapus Filter
                </a>
            </div>
        @endif
        
        <div class="md:hidden space-y-4">
            @forelse ($matches as $match)
                <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden border border-gray-800 group">
                    <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-4 relative overflow-hidden">
                        <div class="absolute top-0 right-0 h-16 w-16">
                            <div class="absolute transform rotate-45 bg-cyan-500 text-gray-900 font-bold text-xs py-1 right-[-35px] top-[15px] w-[130px] text-center uppercase tracking-wider">
                                Match
                            </div>
                        </div>
                        <h3 class="text-lg font-bold tracking-tight text-white mb-1 pr-10">{{ $match->title }}</h3>
                        <p class="text-gray-400 text-sm">{{ $match->teams }}</p>
                    </div>
                    
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3 pb-3 border-b border-gray-800">
                            <div class="flex items-center text-gray-300 text-sm">
                                <i class="far fa-calendar-alt text-cyan-500 mr-2"></i>
                                {{ $match->match_date->format('d M Y, H:i') }}
                            </div>
                            <span class="text-sm text-gray-300">
                                <i class="fas fa-map-marker-alt text-cyan-500 mr-1"></i> {{ $match->venue }}
                            </span>
                        </div>
                        
                        <div class="flex justify-between mb-4">
                            <div class="text-center w-1/2 pr-2">
                                <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Total Tiket</div>
                                <div class="text-xl font-bold text-cyan-400">{{ $match->tickets_count }}</div>
                            </div>
                            <div class="text-center w-1/2 pl-2 border-l border-gray-800">
                                <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Harga</div>
                                <div class="text-xl font-bold text-white">Rp {{ number_format($match->ticket_price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        
                        <a href="{{ route('admin.tickets.show', $match->id) }}" 
                           class="block w-full text-center bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium py-2.5 px-4 rounded transition-all duration-300 group-hover:shadow-lg group-hover:shadow-cyan-500/30">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-user-friends mr-2"></i>
                                <span>Detail Pendaftar</span>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-gray-900 rounded-lg p-8 text-center border border-gray-800">
                    <i class="fas fa-ticket-alt text-cyan-500 text-3xl mb-3"></i>
                    <p class="text-cyan-400 font-medium mb-2">Tidak ada pertandingan yang ditemukan</p>
                    @if(request('search') || request('filter_date'))
                        <p class="text-gray-400">Coba ubah kata kunci pencarian atau filter Anda</p>
                        <a href="{{ route('admin.tickets.index') }}" class="inline-block mt-4 bg-gray-800 hover:bg-gray-700 text-cyan-400 px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-redo mr-1"></i> Tampilkan Semua Pertandingan
                        </a>
                    @else
                        <p class="text-gray-400">Belum ada pertandingan dengan pendaftar tiket.</p>
                    @endif
                </div>
            @endforelse
            
            <div class="mt-4 px-2">
                {{ $matches->appends(request()->query())->links() }}
            </div>
        </div>

        <div class="hidden md:block overflow-x-auto bg-gray-900 rounded-lg tech-border">
            <table class="min-w-full">
                <thead class="bg-gray-800 border-b border-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">ID</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Pertandingan</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Tim</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Venue</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Total Pendaftar</th>
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
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <span class="text-cyan-400 font-medium text-lg mr-1">{{ $match->tickets_count }}</span>
                                    <span class="text-gray-400 text-xs">pendaftar</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.tickets.show', $match->id) }}" 
                                   class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white py-1.5 px-3 rounded text-sm transition-colors flex items-center w-fit">
                                    <i class="fas fa-user-friends mr-1"></i> Detail Pendaftar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 px-4 text-center text-gray-400">
                                <i class="fas fa-ticket-alt text-cyan-500 text-2xl mb-2"></i>
                                <p class="text-cyan-400 font-medium mb-2">Tidak ada pertandingan yang ditemukan</p>
                                @if(request('search') || request('filter_date'))
                                    <p>Coba ubah kata kunci pencarian atau filter Anda</p>
                                    <a href="{{ route('admin.tickets.index') }}" class="inline-block mt-4 bg-gray-800 hover:bg-gray-700 text-cyan-400 px-4 py-2 rounded-lg transition-colors">
                                        <i class="fas fa-redo mr-1"></i> Tampilkan Semua Pertandingan
                                    </a>
                                @else
                                    <p>Belum ada pertandingan dengan pendaftar tiket.</p>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="mt-6 px-4 py-3 border-t border-gray-800">
                {{ $matches->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
    
    <style>
    .pagination {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 1rem;
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
    
    .tech-border {
        box-shadow: 0 0 5px rgba(6, 182, 212, 0.2);
    }
    
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 16px;
        padding-right: 30px;
    }
    
    @media (max-width: 640px) {
        .pagination span, .pagination button, .pagination a {
            min-width: 1.75rem;
            min-height: 1.75rem;
            padding: 0.35rem;
            font-size: 0.75rem;
        }
    }
    </style>
@endsection