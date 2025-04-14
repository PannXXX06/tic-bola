@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="mb-6 bg-gradient-to-r from-gray-900 to-gray-800 p-6 rounded-lg shadow-lg border-l-4 border-cyan-500">
        <h1 class="text-3xl font-bold mb-3 text-white tracking-tight">Daftar Pertandingan</h1>
        <p class="text-gray-400 mb-4">Pilih pertandingan untuk memesan tiket.</p>
        
        <!-- Search Bar -->
        <form action="{{ route('home') }}" method="GET" class="mt-4">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow">
                    <div class="relative">
                        <input type="text" name="search" id="search" placeholder="Cari pertandingan, tim, atau venue..." value="{{ request('search') }}"
                               class="w-full bg-gray-800 border border-gray-700 rounded-lg pl-10 pr-4 py-3 text-white placeholder-gray-500 focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <i class="fas fa-search"></i>
                        </span>
                        @if(request('search'))
                            <a href="{{ route('home') }}" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-cyan-500">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3">
                    <select name="filter_date" class="bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors">
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
    </div>

    @if(request('search') || request('filter_date'))
        <div class="bg-gray-800 p-4 rounded-lg mb-6 flex items-center justify-between">
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
            <a href="{{ route('home') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors text-sm flex items-center">
                <i class="fas fa-times-circle mr-1"></i> Hapus Filter
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($matches as $match)
            <div class="bg-gray-900 rounded-lg shadow-lg overflow-hidden hover:shadow-cyan-500/20 transition-all duration-300 border border-gray-800 group">
                <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-4 relative overflow-hidden">
                    <div class="absolute top-0 right-0 h-16 w-16">
                        <div class="absolute transform rotate-45 bg-cyan-500 text-gray-900 font-bold text-xs py-1 right-[-35px] top-[15px] w-[130px] text-center uppercase tracking-wider">
                            Match
                        </div>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-white mb-2 pr-12">{{ $match->title }}</h2>
                    <div class="flex items-center text-gray-400 text-sm">
                        <i class="far fa-calendar-alt mr-1"></i>
                        {{ $match->match_date->format('d M Y') }}
                        <span class="mx-2">|</span>
                        <i class="far fa-clock mr-1"></i>
                        {{ $match->match_date->format('H:i') }} WIB
                    </div>
                </div>
                
                <div class="p-5">
                    <div class="mb-4 pb-4 border-b border-gray-800">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-users text-cyan-400"></i>
                            </div>
                            <p class="text-white font-medium">{{ $match->teams }}</p>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-map-marker-alt text-cyan-400"></i>
                            </div>
                            <p class="text-gray-400">{{ $match->venue }}</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mb-5">
                        <div class="text-center w-1/2 pr-2">
                            <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Sisa Kursi</div>
                            <div class="text-xl font-bold text-cyan-400">{{ $match->available_seats }}</div>
                        </div>
                        <div class="text-center w-1/2 pl-2 border-l border-gray-800">
                            <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Harga</div>
                            <div class="text-xl font-bold text-white">Rp {{ number_format($match->ticket_price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('tickets.show', $match) }}" 
                       class="block w-full text-center bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium py-3 px-4 rounded transition-all duration-300 group-hover:shadow-lg group-hover:shadow-cyan-500/30">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-ticket-alt mr-2"></i>
                            <span>Lihat Detail & Beli Tiket</span>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-gray-900 rounded-lg p-8 text-center border border-gray-800">
                <i class="fas fa-search-minus text-3xl text-cyan-500 mb-4"></i>
                <p class="text-cyan-400 font-medium mb-2">Tidak ada pertandingan yang ditemukan</p>
                @if(request('search') || request('filter_date'))
                    <p class="text-gray-400">Coba ubah kata kunci pencarian atau filter Anda</p>
                    <a href="{{ route('home') }}" class="inline-block mt-4 bg-gray-800 hover:bg-gray-700 text-cyan-400 px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-redo mr-1"></i> Tampilkan Semua Pertandingan
                    </a>
                @else
                    <p class="text-gray-400">Tidak ada pertandingan yang tersedia saat ini.</p>
                @endif
            </div>
        @endforelse
    </div>
    
    @if($matches->count() > 0 && request()->has('search'))
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="inline-block bg-gray-800 hover:bg-gray-700 text-cyan-400 px-4 py-2 rounded-lg transition-colors">
                <i class="fas fa-sync-alt mr-1"></i> Tampilkan Semua Pertandingan
            </a>
        </div>
    @endif
    
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    input::placeholder {
        color: #6b7280;
        opacity: 1;
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
    </style>
@endsection