<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoalTix - @yield('title', 'Home')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #121212;
            background-image: 
                radial-gradient(circle at 25px 25px, rgba(0, 180, 216, 0.1) 2%, transparent 0%),
                radial-gradient(circle at 75px 75px, rgba(0, 180, 216, 0.05) 2%, transparent 0%);
            background-size: 100px 100px;
            color: #e5e5e5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .tech-glow {
            box-shadow: 0 0 15px rgba(6, 182, 212, 0.3);
        }
        
        .tech-border {
            border: 1px solid rgba(6, 182, 212, 0.3);
        }

        .nav-item {
            position: relative;
            padding: 0.5rem 0.75rem;
            transition: all 0.3s;
        }

        @media (min-width: 768px) {
            .nav-item {
                padding: 0.5rem 1rem;
            }
        }

        .nav-item:hover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #06b6d4, transparent);
        }

        .active-nav-item {
            position: relative;
        }

        .active-nav-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #06b6d4, transparent);
        }
        
        /* Styles for mobile menu */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
    </style>
</head>
<body>
    <header class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center">
                    <i class="fas fa-futbol text-cyan-500 text-2xl mr-2"></i>
                    <span class="text-white font-bold text-xl tracking-tight">Goal<span class="text-cyan-500">Tix</span></span>
                </a>
                
                <!-- Desktop Navigation -->
                <nav class="hidden md:block">
                    <ul class="flex items-center">
                        <li class="nav-item {{ request()->routeIs('home') ? 'active-nav-item' : '' }}">
                            <a href="{{ route('home') }}" class="text-gray-300 hover:text-cyan-400 transition-colors">
                                <i class="fas fa-home mr-1"></i> Home
                            </a>
                        </li>
                        @auth
                            @if(Auth::user()->isAdmin())
                                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active-nav-item' : '' }}">
                                    <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-cyan-400 transition-colors">
                                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button type="submit" class="text-gray-300 hover:text-cyan-400 transition-colors">
                                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            @endif
                        @else
                            <li class="nav-item {{ request()->routeIs('admin.login') ? 'active-nav-item' : '' }}">
                                <a href="{{ route('admin.login') }}" class="text-gray-300 hover:text-cyan-400 transition-colors">
                                    <i class="fas fa-lock mr-1"></i> Admin Login
                                </a>
                            </li>
                        @endauth
                    </ul>
                </nav>
                
                <button class="md:hidden text-gray-300 focus:outline-none" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <div id="mobile-menu" class="mobile-menu fixed top-16 left-0 w-full h-screen bg-gray-900 z-40 md:hidden">
            <nav class="container mx-auto px-4 py-4 border-t border-gray-800">
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('home') }}" class="flex items-center py-2 px-4 rounded {{ request()->routeIs('home') ? 'bg-gray-800 text-cyan-400' : 'text-gray-300' }}">
                            <i class="fas fa-home w-6"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    @auth
                        @if(Auth::user()->isAdmin())
                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2 px-4 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-cyan-400' : 'text-gray-300' }}">
                                    <i class="fas fa-tachometer-alt w-6"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center py-2 px-4 rounded w-full text-left text-gray-300">
                                        <i class="fas fa-sign-out-alt w-6"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </li>
                        @endif
                    @else
                        <li>
                            <a href="{{ route('admin.login') }}" class="flex items-center py-2 px-4 rounded {{ request()->routeIs('admin.login') ? 'bg-gray-800 text-cyan-400' : 'text-gray-300' }}">
                                <i class="fas fa-lock w-6"></i>
                                <span>Admin Login</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </nav>
            <div class="absolute bottom-0 left-0 w-full border-t border-gray-800 py-4 px-4 text-center text-gray-500 text-sm">
                <p>Tap anywhere outside to close</p>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 flex-grow">
        @if(session('success'))
            <div class="bg-gray-800 border-l-4 border-green-500 text-green-400 px-4 py-3 rounded mb-6 flex items-center shadow-lg">
                <i class="fas fa-check-circle mr-3 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gray-800 border-l-4 border-red-500 text-red-400 px-4 py-3 rounded mb-6 flex items-center shadow-lg">
                <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-900 border-t border-gray-800">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <i class="fas fa-futbol text-cyan-500 text-xl mr-2"></i>
                    <span class="text-white font-bold text-lg">Goal<span class="text-cyan-500">Tix</span></span>
                </div>
                <div class="text-gray-400 text-center text-sm md:text-base mb-4 md:mb-0">
                    &copy; {{ date('Y') }} GoalTix - Sistem Ticketing Sepak Bola Modern. All rights reserved.
                </div>
                <div class="flex space-x-6 mt-2 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-cyan-500 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-cyan-500 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-cyan-500 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const overlay = document.getElementById('overlay');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
                overlay.classList.toggle('hidden');
                
                const icon = mobileMenuButton.querySelector('i');
                if (mobileMenu.classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
            
            overlay.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                overlay.classList.add('hidden');
                const icon = mobileMenuButton.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    mobileMenu.classList.remove('active');
                    overlay.classList.add('hidden');
                    const icon = mobileMenuButton.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
        });
    </script>
</body>
</html>