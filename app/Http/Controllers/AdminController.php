<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Matches;
use App\Models\Ticket;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            Auth::logout();
            return back()->withErrors([
                'email' => 'Anda tidak memiliki akses sebagai admin.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ]);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
    public function ticketIndex()
    {
        $matches = Matches::withCount('tickets')
            ->orderBy('match_date')
            ->paginate(5);
            
        return view('admin.tickets.index', compact('matches'));
    }

    public function ticketShow(Matches $match)
    {
        $tickets = $match->tickets()->orderBy('created_at', 'desc')->paginate(10);
        
        $stats = [
            'total_tickets' => $match->tickets()->count(),
            'total_revenue' => $match->tickets()->count() * $match->ticket_price,
            'available_seats' => $match->available_seats,
            'sold_percentage' => ($match->tickets()->count() + $match->available_seats) > 0 
                ? round(($match->tickets()->count() / ($match->tickets()->count() + $match->available_seats)) * 100, 2) 
                : 0,
        ];
        
        $ageGroups = [
            'under_18' => $match->tickets()
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 18')
                ->count(),
            '18_to_30' => $match->tickets()
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 30')
                ->count(),
            '31_to_45' => $match->tickets()
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 31 AND 45')
                ->count(),
            'above_45' => $match->tickets()
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) > 45')
                ->count(),
        ];
        
        $stats['age_groups'] = $ageGroups;
        
        return view('admin.tickets.show', compact('match', 'tickets', 'stats'));
    }

    public function ticketExport(Matches $match)
    {
        return redirect()->route('admin.tickets.show', $match)
            ->with('success', 'Fitur export akan segera tersedia!');
    }
}