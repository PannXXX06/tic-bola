<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'teams',
        'match_date',
        'venue',
        'available_seats',
        'ticket_price',
        'description',
    ];

    protected $casts = [
        'match_date' => 'datetime',
        'ticket_price' => 'decimal:2',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'match_id');
    }
}