@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold mb-2 text-white">Selamat datang, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-400">Kelola tiket pertandingan sepak bola dengan teknologi modern.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden tech-border">
            <div class="bg-gradient-to-r from-gray-700 to-gray-800 p-4 border-b border-gray-700">
                <div class="flex items-center">
                    <div class="bg-gray-900 p-2 rounded-md border border-gray-700 mr-3">
                        <i class="fas fa-futbol text-cyan-500"></i>
                    </div>
                    <h2 class="text-xl font-bold text-white">Management Pertandingan</h2>
                </div>
            </div>
            <div class="p-6">
                <p class="mb-6 text-gray-300">Kelola pertandingan sepak bola, termasuk detail dan tiket yang terdaftar.</p>
                <a href="{{ route('admin.matches.index') }}" 
                   class="inline-block bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium py-2 px-6 rounded tech-border transition duration-300">
                    <div class="flex items-center">
                        <i class="fas fa-futbol mr-2"></i>
                        <span>Lihat Pertandingan</span>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden tech-border">
            <div class="bg-gradient-to-r from-gray-700 to-gray-800 p-4 border-b border-gray-700">
                <div class="flex items-center">
                    <div class="bg-gray-900 p-2 rounded-md border border-gray-700 mr-3">
                        <i class="fas fa-chart-pie text-cyan-500"></i>
                    </div>
                    <h2 class="text-xl font-bold text-white">Statistik</h2>
                </div>
            </div>
            <div class="p-6">
                @php
                    $upcomingMatches = \App\Models\Matches::where('match_date', '>=', now())->count();
                    $totalTickets = \App\Models\Ticket::count();
                    $totalRevenue = \App\Models\Ticket::join('matches', 'tickets.match_id', '=', 'matches.id')
                        ->sum(DB::raw('matches.ticket_price'));
                @endphp
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-gray-900 rounded p-4 text-center border border-gray-700 tech-border">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-calendar-alt text-cyan-500 mr-2"></i>
                            <span class="text-xs uppercase tracking-wider text-gray-400">Mendatang</span>
                        </div>
                        <span class="block text-2xl font-bold text-cyan-400">{{ $upcomingMatches }}</span>
                        <span class="text-xs text-gray-400 uppercase tracking-wider">Pertandingan</span>
                    </div>
                    <div class="bg-gray-900 rounded p-4 text-center border border-gray-700 tech-border">
                        <div class="flex items-center justify-center mb-2">
                            <i class="fas fa-ticket-alt text-cyan-500 mr-2"></i>
                            <span class="text-xs uppercase tracking-wider text-gray-400">Terjual</span>
                        </div>
                        <span class="block text-2xl font-bold text-cyan-400">{{ $totalTickets }}</span>
                        <span class="text-xs text-gray-400 uppercase tracking-wider">Tiket</span>
                    </div>
                </div>
                
                <div class="bg-gray-900 rounded p-4 text-center border border-gray-700 tech-border">
                    <div class="flex items-center justify-center mb-2">
                        <i class="fas fa-money-bill-wave text-cyan-500 mr-2"></i>
                        <span class="text-xs uppercase tracking-wider text-gray-400">Pendapatan</span>
                    </div>
                    <span class="block text-2xl font-bold text-cyan-400">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
                    <span class="text-xs text-gray-400 uppercase tracking-wider">Total</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden tech-border">
        <div class="bg-gradient-to-r from-gray-700 to-gray-800 p-4 border-b border-gray-700 flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-gray-900 p-2 rounded-md border border-gray-700 mr-3">
                    <i class="fas fa-calendar-alt text-cyan-500"></i>
                </div>
                <h2 class="text-xl font-bold text-white">Pertandingan Mendatang</h2>
            </div>
            <span class="bg-gray-900 text-gray-300 px-3 py-1 rounded-md text-xs border border-gray-700 tech-border">
                <i class="far fa-clock mr-1 text-cyan-500"></i> Jadwal Terkini
            </span>
        </div>
        
        @php
            $upcomingMatches = \App\Models\Matches::where('match_date', '>=', now())
                ->orderBy('match_date')
                ->limit(5)
                ->get();
        @endphp
        
        @if($upcomingMatches->count() > 0)
            <div class="divide-y divide-gray-700">
                @foreach($upcomingMatches as $match)
                    <div class="p-5 hover:bg-gray-700/30 transition duration-200">
                        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
                            <div class="flex items-start md:w-1/3">
                                <div class="bg-gray-900 h-12 w-12 rounded-md flex items-center justify-center border border-gray-700 mr-3 flex-shrink-0">
                                    <i class="fas fa-futbol text-cyan-500 text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-lg">{{ $match->title }}</h4>
                                    <p class="text-sm text-gray-400">{{ $match->teams }}</p>
                                    <div class="mt-1 flex items-center text-xs text-gray-500">
                                        <i class="fas fa-map-marker-alt text-cyan-500 mr-1"></i>
                                        <span>{{ $match->venue }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="md:w-1/4 text-center">
                                <div class="bg-gray-900 py-3 px-4 rounded-lg border border-gray-700 tech-border inline-block">
                                    <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Tanggal & Waktu</div>
                                    <div class="flex items-center justify-center text-gray-300">
                                        <i class="far fa-calendar-alt text-cyan-500 mr-2"></i>
                                        <span>{{ $match->match_date->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center justify-center text-gray-300 mt-1">
                                        <i class="far fa-clock text-cyan-500 mr-2"></i>
                                        <span>{{ $match->match_date->format('H:i') }} WIB</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="md:w-1/4">
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-gray-900 p-3 rounded border border-gray-700 tech-border text-center">
                                        <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Sisa Kursi</div>
                                        <div class="font-bold text-lg text-cyan-400">{{ $match->available_seats }}</div>
                                    </div>
                                    <div class="bg-gray-900 p-3 rounded border border-gray-700 tech-border text-center">
                                        <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Terjual</div>
                                        <div class="font-bold text-lg text-cyan-400">{{ $match->tickets()->count() }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="md:w-1/6 flex justify-center">
                                <a href="{{ route('admin.matches.show', $match) }}" 
                                   class="bg-gray-900 hover:bg-gray-700 border border-gray-700 text-cyan-500 hover:text-cyan-400 rounded-lg px-4 py-2 inline-flex items-center justify-center transition-all duration-200 tech-border">
                                    <span>Detail</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-8 text-center text-gray-400 bg-gray-900/50">
                <i class="fas fa-calendar-times text-cyan-500 text-3xl mb-3"></i>
                <p class="font-medium">Tidak ada pertandingan mendatang yang terdaftar.</p>
                <p class="text-sm mt-2">Tambahkan pertandingan baru untuk mulai menjual tiket.</p>
            </div>
        @endif
        
        <div class="p-4 border-t border-gray-700 bg-gray-900/20 text-center">
            <a href="{{ route('admin.matches.index') }}" class="text-cyan-500 hover:text-cyan-400 inline-flex items-center transition-colors font-medium">
                <span>Lihat semua pertandingan</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
    
    <style>
    .tech-border {
        box-shadow: 0 0 5px rgba(6, 182, 212, 0.2);
    }
    </style>
@endsection