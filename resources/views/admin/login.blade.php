@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    <div class="max-w-md mx-auto">
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-gray-800 mb-4 tech-glow">
                <i class="fas fa-user-shield text-cyan-500 text-3xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Admin Login</h1>
            <p class="text-gray-400 mt-2">Login khusus untuk Admin</p>
        </div>
        
        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden tech-border">
            <div class="py-4 px-6 bg-gradient-to-r from-gray-700 to-gray-800 border-b border-gray-700 flex items-center">
                <div class="bg-gray-900 p-2 rounded-md mr-3 border border-gray-700">
                    <i class="fas fa-lock text-cyan-500"></i>
                </div>
                <h2 class="text-xl font-bold text-white">Login Admin</h2>
            </div>
            
            <form method="POST" action="{{ route('admin.login.post') }}" class="py-6 px-8">
                @csrf
                
                <div class="mb-5">
                    <label for="email" class="block text-gray-300 font-medium mb-2">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                               class="w-full bg-gray-900 border border-gray-700 rounded pl-10 py-3 text-white placeholder-gray-500 focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                               placeholder="admin@example.com"
                               required autofocus>
                    </div>
                    @error('email')
                        <p class="text-red-400 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-gray-300 font-medium mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <i class="fas fa-key"></i>
                        </span>
                        <input type="password" name="password" id="password" 
                               class="w-full bg-gray-900 border border-gray-700 rounded pl-10 py-3 text-white placeholder-gray-500 focus:border-cyan-500 focus:ring focus:ring-cyan-500/30 transition-colors"
                               placeholder="••••••••"
                               required>
                        <span id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 cursor-pointer hover:text-gray-300">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <p class="text-red-400 text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium py-3 px-4 rounded tech-border transition-colors flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </button>
                
                <div class="mt-4 text-center text-gray-500 text-sm">
                    <p>Sistem ticketing untuk pertandingan sepak bola</p>
                </div>
            </form>
        </div>
        
        <div class="mt-8 bg-gray-800/50 rounded-lg p-4 border border-gray-700">
            <div class="flex items-center text-gray-400 text-sm">
                <i class="fas fa-info-circle text-cyan-500 mr-2"></i>
                <p>Masuk ke panel admin untuk mengelola pertandingan dan tiket.</p>
            </div>
        </div>
    </div>
    
    <style>
    .tech-border {
        box-shadow: 0 0 15px rgba(6, 182, 212, 0.2);
    }
    .tech-glow {
        box-shadow: 0 0 20px rgba(6, 182, 212, 0.3);
    }
    
    input:focus {
        box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.2);
        outline: none;
    }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    </script>
@endsection