<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchController extends Controller
{
    public function index()
    {
        $matches = Matches::orderBy('match_date')->paginate(5);
        return view('admin.matches.index', compact('matches'));
    }
    
    public function create()
    {
        return view('admin.matches.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'teams' => 'required|string|max:255',
            'match_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'available_seats' => 'required|integer|min:1',
            'ticket_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Matches::create($validated);

        return redirect()->route('admin.matches.index')
            ->with('success', 'Pertandingan berhasil ditambahkan!');
    }

    public function show(Matches $match)
    {
        $tickets = $match->tickets()->orderBy('created_at', 'desc')->get();
        
        $stats = [
            'total_tickets' => $tickets->count(),
            'total_revenue' => $tickets->count() * $match->ticket_price,
            'available_seats' => $match->available_seats,
            'seats_total' => $tickets->count() + $match->available_seats,
            'sold_percentage' => ($tickets->count() + $match->available_seats) > 0 
                ? round(($tickets->count() / ($tickets->count() + $match->available_seats)) * 100, 2) 
                : 0,
        ];
        
        $ageGroups = [
            'under_18' => 0,
            '18_to_30' => 0,
            '31_to_45' => 0,
            'above_45' => 0,
        ];
        
        foreach ($tickets as $ticket) {
            $age = now()->diffInYears($ticket->birth_date);
            
            if ($age < 18) {
                $ageGroups['under_18']++;
            } elseif ($age >= 18 && $age <= 30) {
                $ageGroups['18_to_30']++;
            } elseif ($age > 30 && $age <= 45) {
                $ageGroups['31_to_45']++;
            } else {
                $ageGroups['above_45']++;
            }
        }
        
        $stats['age_groups'] = $ageGroups;
        
        return view('admin.matches.show', compact('match', 'tickets', 'stats'));
    }

    public function edit(Matches $match)
    {
        return view('admin.matches.edit', compact('match'));
    }

    public function update(Request $request, Matches $match)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'teams' => 'required|string|max:255',
            'match_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'available_seats' => 'required|integer|min:1',
            'ticket_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $match->update($validated);

        return redirect()->route('admin.matches.index')
            ->with('success', 'Pertandingan berhasil diperbarui!');
    }

    public function destroy(Matches $match)
    {
        $match->delete();

        return redirect()->route('admin.matches.index')
            ->with('success', 'Pertandingan berhasil dihapus!');
    }
}