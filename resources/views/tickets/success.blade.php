@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil')

@section('content')
    <div class="max-w-2xl mx-auto mb-6">
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-lg shadow-lg overflow-hidden border-l-4 border-cyan-500 hover:shadow-cyan-500/20 transition-all duration-300">
            <div class="p-6 text-center">
                <div class="w-20 h-20 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full mx-auto flex items-center justify-center mb-6">
                    <i class="fas fa-check text-white text-3xl"></i>
                </div>
                
                <h1 class="text-3xl font-bold mb-3 text-white tracking-tight">Pendaftaran Tiket Berhasil!</h1>
                
                <p class="text-gray-400 mb-6">
                    Terima kasih telah mendaftar untuk pertandingan <strong class="text-white">{{ $match->title }}</strong>.
                    Detail konfirmasi telah dikirim ke email Anda.
                </p>

                <div class="mb-6 p-4 bg-gray-800 rounded-lg border border-gray-700">
                    <h2 class="font-semibold mb-4 text-cyan-400 text-lg">Detail Pertandingan:</h2>
                    
                    <div class="mb-4 pb-4 border-b border-gray-700">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-users text-cyan-400"></i>
                            </div>
                            <p class="text-white font-medium">{{ $match->teams }}</p>
                        </div>
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-calendar-alt text-cyan-400"></i>
                            </div>
                            <p class="text-gray-300">{{ $match->match_date->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-map-marker-alt text-cyan-400"></i>
                            </div>
                            <p class="text-gray-300">{{ $match->venue }}</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mb-2">
                        <div class="text-center w-1/2 pr-2">
                            <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Kode Booking</div>
                            <div class="text-xl font-bold text-cyan-400">{{ strtoupper(substr(md5(time()), 0, 8)) }}</div>
                        </div>
                        <div class="text-center w-1/2 pl-2 border-l border-gray-700">
                            <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Status</div>
                            <div class="text-xl font-bold text-green-400">CONFIRMED</div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}" 
                       class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium py-3 px-6 rounded transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/30 flex items-center justify-center">
                        <i class="fas fa-home mr-2"></i>
                        <span>Kembali ke Home</span>
                    </a>
                    
                    <button onclick="window.print()" 
                            class="bg-gray-800 hover:bg-gray-700 text-cyan-400 font-medium py-3 px-6 rounded transition-colors flex items-center justify-center border border-gray-700">
                        <i class="fas fa-print mr-2"></i>
                        <span>Cetak Tiket</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    
    @media print {
        body * {
            visibility: hidden;
        }
        .max-w-2xl, .max-w-2xl * {
            visibility: visible;
        }
        .max-w-2xl {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        a, button {
            display: none !important;
        }
    }
    </style>
@endsection