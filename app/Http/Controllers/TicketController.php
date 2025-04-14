<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show(Matches $match)
    {
        return view('tickets.show', compact('match'));
    }

    public function store(Request $request, Matches $match)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'birth_date' => 'required|date|before:today',
        ]);

        $validated['match_id'] = $match->id;

        if ($match->available_seats > 0) {
            $match->decrement('available_seats');
        } else {
            return back()->with('error', 'Maaf, tiket sudah habis!');
        }

        Ticket::create($validated);

        return redirect()->route('tickets.success', $match);
    }

    public function success(Matches $match)
    {
        return view('tickets.success', compact('match'));
    }
}