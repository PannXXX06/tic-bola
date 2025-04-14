@extends('layouts.admin')

@section('title', 'Detail Pendaftar Tiket')

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 tech-border mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div class="flex items-center">
                <div class="bg-gray-900 p-2 rounded-md mr-3 border border-gray-700">
                    <i class="fas fa-users text-cyan-500"></i>
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-bold text-white">Pendaftar Tiket</h1>
                    <p class="text-gray-400">{{ $match->title }}</p>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <a href="{{ route('admin.matches.show', $match->id) }}" 
                   class="bg-gray-700 hover:bg-gray-600 text-cyan-400 font-medium py-2 px-4 rounded border border-gray-600 transition-colors flex items-center justify-center">
                    <i class="fas fa-info-circle mr-2"></i> Detail Pertandingan
                </a>
            </div>
        </div>
        
        <div class="bg-gray-900 rounded-lg p-4 mb-6 border border-gray-800">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center">
                    <div class="bg-gray-800 p-2 rounded-full mr-3 h-10 w-10 flex items-center justify-center border border-gray-700">
                        <i class="fas fa-calendar-alt text-cyan-500"></i>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 uppercase tracking-wider">Tanggal & Waktu</span>
                        <p class="text-white">{{ $match->match_date->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="bg-gray-800 p-2 rounded-full mr-3 h-10 w-10 flex items-center justify-center border border-gray-700">
                        <i class="fas fa-map-marker-alt text-cyan-500"></i>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 uppercase tracking-wider">Venue</span>
                        <p class="text-white">{{ $match->venue }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="bg-gray-800 p-2 rounded-full mr-3 h-10 w-10 flex items-center justify-center border border-gray-700">
                        <i class="fas fa-users text-cyan-500"></i>
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 uppercase tracking-wider">Tim</span>
                        <p class="text-white">{{ $match->teams }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gray-900 rounded-lg p-4 text-center border border-gray-800">
                <div class="bg-gray-800 h-10 w-10 mx-auto rounded-full flex items-center justify-center mb-2 border border-gray-700">
                    <i class="fas fa-ticket-alt text-cyan-500"></i>
                </div>
                <span class="block text-xl font-bold text-cyan-400">{{ $stats['total_tickets'] }}</span>
                <span class="text-xs uppercase tracking-wider text-gray-400">Total Pendaftar</span>
            </div>
            <div class="bg-gray-900 rounded-lg p-4 text-center border border-gray-800">
                <div class="bg-gray-800 h-10 w-10 mx-auto rounded-full flex items-center justify-center mb-2 border border-gray-700">
                    <i class="fas fa-percentage text-green-500"></i>
                </div>
                <span class="block text-xl font-bold {{ $stats['sold_percentage'] > 70 ? 'text-green-400' : ($stats['sold_percentage'] > 30 ? 'text-yellow-400' : 'text-red-400') }}">{{ $stats['sold_percentage'] }}%</span>
                <span class="text-xs uppercase tracking-wider text-gray-400">Persentase Terjual</span>
            </div>
            <div class="bg-gray-900 rounded-lg p-4 text-center border border-gray-800">
                <div class="bg-gray-800 h-10 w-10 mx-auto rounded-full flex items-center justify-center mb-2 border border-gray-700">
                    <i class="fas fa-money-bill-wave text-green-500"></i>
                </div>
                <span class="block text-xl font-bold text-green-400">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
                <span class="text-xs uppercase tracking-wider text-gray-400">Total Pendapatan</span>
            </div>
            <div class="bg-gray-900 rounded-lg p-4 text-center border border-gray-800">
                <div class="bg-gray-800 h-10 w-10 mx-auto rounded-full flex items-center justify-center mb-2 border border-gray-700">
                    <i class="fas fa-chair text-yellow-500"></i>
                </div>
                <span class="block text-xl font-bold text-yellow-400">{{ $stats['available_seats'] }}</span>
                <span class="text-xs uppercase tracking-wider text-gray-400">Sisa Kursi</span>
            </div>
        </div>
        
        <div class="bg-gray-900 rounded-lg p-4 mb-6 border border-gray-800">
            <h3 class="text-white font-semibold mb-4 flex items-center">
                <i class="fas fa-chart-bar text-cyan-500 mr-2"></i> Distribusi Usia Penonton
            </h3>
            
            @php
                $totalTickets = $stats['total_tickets'];
                $under18Percent = $totalTickets > 0 ? ($stats['age_groups']['under_18'] / $totalTickets) * 100 : 0;
                $age18to30Percent = $totalTickets > 0 ? ($stats['age_groups']['18_to_30'] / $totalTickets) * 100 : 0;
                $age31to45Percent = $totalTickets > 0 ? ($stats['age_groups']['31_to_45'] / $totalTickets) * 100 : 0;
                $ageAbove45Percent = $totalTickets > 0 ? ($stats['age_groups']['above_45'] / $totalTickets) * 100 : 0;
            @endphp
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs text-gray-400 mb-1">
                            <span>Di bawah 18 tahun</span>
                            <span>{{ round($under18Percent, 1) }}% ({{ $stats['age_groups']['under_18'] }})</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $under18Percent }}%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-xs text-gray-400 mb-1">
                            <span>18-30 tahun</span>
                            <span>{{ round($age18to30Percent, 1) }}% ({{ $stats['age_groups']['18_to_30'] }})</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $age18to30Percent }}%"></div>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs text-gray-400 mb-1">
                            <span>31-45 tahun</span>
                            <span>{{ round($age31to45Percent, 1) }}% ({{ $stats['age_groups']['31_to_45'] }})</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $age31to45Percent }}%"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-xs text-gray-400 mb-1">
                            <span>Di atas 45 tahun</span>
                            <span>{{ round($ageAbove45Percent, 1) }}% ({{ $stats['age_groups']['above_45'] }})</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: {{ $ageAbove45Percent }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <h3 class="text-white font-semibold flex items-center">
                <i class="fas fa-user-friends text-cyan-500 mr-2"></i> Daftar Penonton
            </h3>
            
            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                <div class="relative">
                    <input type="text" id="ticket-search" placeholder="Cari nama/email..." class="w-full sm:w-60 bg-gray-900 border border-gray-700 rounded-lg pl-10 py-2 text-white placeholder-gray-500 focus:border-cyan-500 focus:ring focus:ring-cyan-500/30">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="md:hidden space-y-4">
            @forelse($tickets as $ticket)
                @php
                    $birthDate = \Carbon\Carbon::parse($ticket->birth_date);
                    $age = $birthDate->age;
                @endphp
                <div class="bg-gray-900 rounded-lg border border-gray-800 overflow-hidden ticket-item">
                    <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-3 border-b border-gray-800">
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-white ticket-name">{{ $ticket->name }}</h4>
                            <span class="text-xs bg-gray-800 text-cyan-400 px-2 py-1 rounded-full border border-gray-700">
                                ID: {{ $ticket->id }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-3 space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-cyan-500 w-5 text-center mr-2"></i>
                            <span class="text-gray-300 ticket-email">{{ $ticket->email }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-birthday-cake text-cyan-500 w-5 text-center mr-2"></i>
                            <span class="text-gray-300">{{ $age }} tahun</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-cyan-500 w-5 text-center mr-2"></i>
                            <span class="text-gray-300">{{ $ticket->address }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-cyan-500 w-5 text-center mr-2"></i>
                            <span class="text-gray-400 text-sm">Terdaftar: {{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-gray-900 rounded-lg p-8 text-center border border-gray-800 no-tickets">
                    <i class="fas fa-user-times text-cyan-500 text-2xl mb-2"></i>
                    <p class="text-cyan-400 font-medium">Belum ada pendaftar untuk pertandingan ini.</p>
                </div>
            @endforelse
            
            <div class="bg-gray-900 rounded-lg p-8 text-center border border-gray-800 hidden" id="mobile-empty-results">
                <i class="fas fa-search text-cyan-500 text-2xl mb-2"></i>
                <p class="text-cyan-400 font-medium">Tidak ada hasil yang cocok dengan pencarian Anda.</p>
                <button type="button" onclick="clearSearch()" class="mt-3 bg-gray-800 hover:bg-gray-700 text-cyan-400 px-4 py-2 rounded-lg text-sm">
                    Reset Pencarian
                </button>
            </div>
            
            <div class="mt-4 px-2">
                {{ $tickets->links() }}
            </div>
        </div>
        
        <div class="hidden md:block overflow-x-auto bg-gray-900 rounded-lg tech-border">
            <table class="min-w-full">
                <thead class="bg-gray-800 border-b border-gray-700">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">ID</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Nama</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Alamat</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Umur</th>
                        <th class="py-3 px-4 text-left text-xs text-gray-400 uppercase tracking-wider">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($tickets as $ticket)
                        @php
                            $birthDate = \Carbon\Carbon::parse($ticket->birth_date);
                            $age = $birthDate->age;
                        @endphp
                        <tr class="hover:bg-gray-800/70 transition-colors ticket-row">
                            <td class="py-3 px-4 text-sm text-gray-300">{{ $ticket->id }}</td>
                            <td class="py-3 px-4 text-sm text-white ticket-name">{{ $ticket->name }}</td>
                            <td class="py-3 px-4 text-sm text-gray-300 ticket-email">{{ $ticket->email }}</td>
                            <td class="py-3 px-4 text-sm text-gray-300">{{ Str::limit($ticket->address, 30) }}</td>
                            <td class="py-3 px-4 text-sm text-cyan-400">{{ $age }} tahun</td>
                            <td class="py-3 px-4 text-sm text-gray-400">
                                <i class="far fa-clock mr-1"></i> 
                                {{ $ticket->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr class="no-tickets">
                            <td colspan="6" class="py-8 px-4 text-center text-gray-400">
                                <i class="fas fa-user-times text-cyan-500 text-2xl mb-2"></i>
                                <p>Belum ada pendaftar untuk pertandingan ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="py-8 px-4 text-center text-gray-400 hidden" id="desktop-empty-results">
                <i class="fas fa-search text-cyan-500 text-2xl mb-2"></i>
                <p>Tidak ada hasil yang cocok dengan pencarian Anda.</p>
                <button type="button" onclick="clearSearch()" class="mt-3 bg-gray-800 hover:bg-gray-700 text-cyan-400 px-4 py-2 rounded-lg text-sm">
                    Reset Pencarian
                </button>
            </div>
            
            <div class="mt-6 px-4 py-3 border-t border-gray-800">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
    
    <div class="text-center mt-6 mb-8">
        <a href="{{ route('admin.tickets.index') }}" class="text-cyan-400 hover:text-cyan-300 transition-colors flex items-center justify-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke daftar tiket
        </a>
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
    
    @media (max-width: 640px) {
        .pagination span, .pagination button, .pagination a {
            min-width: 1.75rem;
            min-height: 1.75rem;
            padding: 0.35rem;
            font-size: 0.75rem;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('ticket-search');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                let mobileFoundCount = 0;
                let desktopFoundCount = 0;
                
                const mobileCards = document.querySelectorAll('.md\\:hidden .ticket-item');
                const mobileEmptyState = document.getElementById('mobile-empty-results');
                const defaultMobileEmptyState = document.querySelector('.md\\:hidden .no-tickets');
                
                mobileCards.forEach(card => {
                    const name = card.querySelector('.ticket-name').textContent.toLowerCase();
                    const email = card.querySelector('.ticket-email').textContent.toLowerCase();
                    
                    if (searchTerm === '' || name.includes(searchTerm) || email.includes(searchTerm)) {
                        card.classList.remove('hidden');
                        mobileFoundCount++;
                    } else {
                        card.classList.add('hidden');
                    }
                });
                
                if (mobileFoundCount === 0 && mobileCards.length > 0 && searchTerm !== '') {
                    if (defaultMobileEmptyState) defaultMobileEmptyState.classList.add('hidden');
                    mobileEmptyState.classList.remove('hidden');
                } else {
                    if (defaultMobileEmptyState) defaultMobileEmptyState.classList.remove('hidden');
                    mobileEmptyState.classList.add('hidden');
                }
                
                const tableRows = document.querySelectorAll('.hidden.md\\:block .ticket-row');
                const desktopEmptyState = document.getElementById('desktop-empty-results');
                const defaultDesktopEmptyState = document.querySelector('.hidden.md\\:block .no-tickets');
                
                tableRows.forEach(row => {
                    const name = row.querySelector('.ticket-name').textContent.toLowerCase();
                    const email = row.querySelector('.ticket-email').textContent.toLowerCase();
                    
                    if (searchTerm === '' || name.includes(searchTerm) || email.includes(searchTerm)) {
                        row.classList.remove('hidden');
                        desktopFoundCount++;
                    } else {
                        row.classList.add('hidden');
                    }
                });
                
                // Handle empty results state for desktop
                if (desktopFoundCount === 0 && tableRows.length > 0 && searchTerm !== '') {
                    if (defaultDesktopEmptyState) defaultDesktopEmptyState.classList.add('hidden');
                    desktopEmptyState.classList.remove('hidden');
                } else {
                    if (defaultDesktopEmptyState) defaultDesktopEmptyState.classList.remove('hidden');
                    desktopEmptyState.classList.add('hidden');
                }
            });
        }
    });
    
    function clearSearch() {
        const searchInput = document.getElementById('ticket-search');
        if (searchInput) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('keyup'));
            searchInput.focus();
        }
    }
    </script>
@endsection