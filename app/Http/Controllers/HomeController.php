<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Matches::where('match_date', '>=', now());

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('teams', 'like', "%{$searchTerm}%")
                  ->orWhere('venue', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('filter_date') && !empty($request->filter_date)) {
            if ($request->filter_date === 'today') {
                $query->whereDate('match_date', Carbon::today());
            } elseif ($request->filter_date === 'this-week') {
                $query->whereBetween('match_date', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            } elseif ($request->filter_date === 'this-month') {
                $query->whereMonth('match_date', Carbon::now()->month)
                      ->whereYear('match_date', Carbon::now()->year);
            }
        }

        $matches = $query->orderBy('match_date')->get();
            
        return view('home', compact('matches'));
    }
}