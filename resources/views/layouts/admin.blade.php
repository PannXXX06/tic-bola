<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
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
            transition: all 0.2s ease;
        }
        
        .nav-item::before {
            content: '';
            position: absolute;
            left: -10px;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: #06b6d4;
            transition: height 0.2s ease;
        }
        
        .nav-item:hover::before, .nav-item.active::before {
            height: 70%;
        }
        
        .nav-item:hover, .nav-item.active {
            transform: translateX(5px);
        }
        
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .mobile-menu.active {
            transform: translateX(0);
        }
        
        @media (max-width: 768px) {
            .desktop-sidebar {
                display: none;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="flex">
        <aside class="desktop-sidebar w-64 bg-gray-900 text-gray-300 min-h-screen fixed shadow-lg border-r border-gray-800 z-20">
            <div class="p-6 border-b border-gray-800 text-center">
                <div class="bg-gradient-to-r from-gray-800 to-gray-900 tech-border rounded-lg p-4 mb-2 tech-glow">
                    <div class="flex items-center justify-center mb-1">
                        <i class="fas fa-futbol text-cyan-500 text-xl mr-2"></i>
                        <h1 class="text-xl font-bold text-white tracking-tight">Goal<span class="text-cyan-500">Tix</span></h1>
                    </div>
                    <div class="text-xs text-gray-400 uppercase tracking-wider">Admin Panel</div>
                </div>
            </div>
            
            <nav class="mt-6 px-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="nav-item flex items-center p-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-cyan-400 active' : 'text-gray-400 hover:bg-gray-800/50 hover:text-cyan-400' }}">
                           <i class="fas fa-tachometer-alt w-5 text-center mr-3"></i>
                           <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.matches.index') }}" 
                           class="nav-item flex items-center p-3 rounded-lg {{ request()->routeIs('admin.matches.*') ? 'bg-gray-800 text-cyan-400 active' : 'text-gray-400 hover:bg-gray-800/50 hover:text-cyan-400' }}">
                           <i class="fas fa-futbol w-5 text-center mr-3"></i>
                           <span class="font-medium">Matches</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tickets.index') }}" 
                           class="nav-item flex items-center p-3 rounded-lg {{ request()->routeIs('admin.tickets.*') ? 'bg-gray-800 text-cyan-400 active' : 'text-gray-400 hover:bg-gray-800/50 hover:text-cyan-400' }}">
                           <i class="fas fa-ticket-alt w-5 text-center mr-3"></i>
                           <span class="font-medium">Tickets</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="p-4 absolute bottom-4 w-full px-6">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white py-2 px-4 rounded tech-border transition duration-300">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span class="font-medium">Logout</span>
                        </div>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile Sidebar Menu -->
        <div id="mobile-menu" class="mobile-menu fixed top-16 left-0 w-full h-screen bg-gray-900 z-40 md:hidden">
            <nav class="px-4 py-6 border-t border-gray-800">
                <div class="mb-6 text-center">
                    <div class="inline-flex items-center justify-center">
                        <i class="fas fa-futbol text-cyan-500 text-xl mr-2"></i>
                        <h1 class="text-xl font-bold text-white tracking-tight">Goal<span class="text-cyan-500">Tix</span></h1>
                    </div>
                </div>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center p-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-cyan-400' : 'text-gray-400 hover:bg-gray-800/50 hover:text-cyan-400' }}">
                           <i class="fas fa-tachometer-alt w-6 text-center mr-3"></i>
                           <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.matches.index') }}" 
                           class="flex items-center p-3 rounded-lg {{ request()->routeIs('admin.matches.*') ? 'bg-gray-800 text-cyan-400' : 'text-gray-400 hover:bg-gray-800/50 hover:text-cyan-400' }}">
                           <i class="fas fa-futbol w-6 text-center mr-3"></i>
                           <span class="font-medium">Matches</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tickets.index') }}" 
                           class="flex items-center p-3 rounded-lg {{ request()->routeIs('admin.tickets.*') ? 'bg-gray-800 text-cyan-400' : 'text-gray-400 hover:bg-gray-800/50 hover:text-cyan-400' }}">
                           <i class="fas fa-ticket-alt w-6 text-center mr-3"></i>
                           <span class="font-medium">Tickets</span>
                        </a>
                    </li>
                </ul>
                
                <div class="mt-8 px-3">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white py-2 px-4 rounded tech-border transition duration-300">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                <span class="font-medium">Logout</span>
                            </div>
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <div class="main-content w-full md:ml-64 flex-1">
            <header class="bg-gray-900 text-white shadow-lg border-b border-gray-800 sticky top-0 z-10">
                <div class="py-4 px-6 flex justify-between items-center">
                    <button id="mobile-menu-button" class="md:hidden text-gray-400 hover:text-cyan-500 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <div class="flex items-center">
                        <div class="bg-gray-800 p-2 rounded-md border border-gray-700 mr-3">
                            <i class="fas fa-server text-cyan-500"></i>
                        </div>
                        <h2 class="text-xl font-bold tracking-tight">@yield('title', 'Dashboard')</h2>
                    </div>
                    
                    <div class="w-8 md:w-24"></div>
                </div>
            </header>
            
            <main class="p-4 md:p-6">
                @if(session('success'))
                    <div class="bg-gray-800 border-l-4 border-green-500 text-green-400 p-4 mb-6 rounded flex items-start tech-border">
                        <i class="fas fa-check-circle mt-1 mr-3"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-gray-800 border-l-4 border-red-500 text-red-400 p-4 mb-6 rounded flex items-start tech-border">
                        <i class="fas fa-exclamation-circle mt-1 mr-3"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    
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