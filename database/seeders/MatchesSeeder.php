<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matches;
use Carbon\Carbon;

class MatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matches = [
            [
                'title' => 'Final Liga Champions: Real Madrid vs Liverpool',
                'teams' => 'Real Madrid vs Liverpool',
                'match_date' => Carbon::now()->addDays(30)->setHour(19)->setMinute(45),
                'venue' => 'Stadion Wembley, London',
                'available_seats' => 1200,
                'ticket_price' => 1500000,
                'description' => 'Final Liga Champions UEFA 2025 mempertemukan juara bertahan Real Madrid melawan Liverpool dalam pertandingan yang dijanjikan akan penuh aksi dan drama.',
            ],
            [
                'title' => 'Derby Manchester: Man United vs Man City',
                'teams' => 'Manchester United vs Manchester City',
                'match_date' => Carbon::now()->addDays(15)->setHour(20)->setMinute(00),
                'venue' => 'Old Trafford, Manchester',
                'available_seats' => 800,
                'ticket_price' => 1200000,
                'description' => 'Derby Manchester kembali hadir dengan rivalitas klasik antara setan merah dan the citizens yang selalu menawarkan pertandingan intensitas tinggi.',
            ],
            [
                'title' => 'El Clasico: Barcelona vs Real Madrid',
                'teams' => 'FC Barcelona vs Real Madrid',
                'match_date' => Carbon::now()->addDays(45)->setHour(21)->setMinute(30),
                'venue' => 'Camp Nou, Barcelona',
                'available_seats' => 950,
                'ticket_price' => 1800000,
                'description' => 'El Clasico kembali hadir dengan persaingan dua raksasa Spanyol yang selalu menghiasi sepak bola dunia dengan permainan berkelas dan gengsi tinggi.',
            ],
            [
                'title' => 'Liga 1 Indonesia: Persija vs Persib',
                'teams' => 'Persija Jakarta vs Persib Bandung',
                'match_date' => Carbon::now()->addDays(10)->setHour(15)->setMinute(30),
                'venue' => 'Stadion Gelora Bung Karno, Jakarta',
                'available_seats' => 2000,
                'ticket_price' => 300000,
                'description' => 'Duel El Clasico Indonesia antara Persija Jakarta melawan Persib Bandung yang selalu memberikan atmosfer luar biasa dan pertandingan berkualitas.',
            ],
            [
                'title' => 'Liga 1 Indonesia: PSM vs Arema',
                'teams' => 'PSM Makassar vs Arema FC',
                'match_date' => Carbon::now()->addDays(12)->setHour(16)->setMinute(00),
                'venue' => 'Stadion BJ Habibie, Makassar',
                'available_seats' => 1500,
                'ticket_price' => 250000,
                'description' => 'Pertandingan seru antara juara bertahan PSM Makassar melawan Arema FC yang akan mempertontonkan permainan menarik dari kedua tim.',
            ],
            [
                'title' => 'Piala Dunia 2026: Brasil vs Argentina',
                'teams' => 'Brasil vs Argentina',
                'match_date' => Carbon::now()->addMonths(8)->setHour(18)->setMinute(00),
                'venue' => 'MetLife Stadium, New Jersey',
                'available_seats' => 500,
                'ticket_price' => 2500000,
                'description' => 'Pertandingan klasik Amerika Selatan antara dua raksasa sepak bola dunia Brasil dan Argentina dengan bintang-bintang top dunia.',
            ],
            [
                'title' => 'Premier League: Liverpool vs Chelsea',
                'teams' => 'Liverpool FC vs Chelsea FC',
                'match_date' => Carbon::now()->addDays(22)->setHour(17)->setMinute(30),
                'venue' => 'Anfield, Liverpool',
                'available_seats' => 700,
                'ticket_price' => 1100000,
                'description' => 'Duel seru di Liga Inggris antara Liverpool dan Chelsea yang mempertemukan dua klub dengan sejarah panjang persaingan di liga domestik dan Eropa.',
            ],
            [
                'title' => 'Serie A: AC Milan vs Inter Milan',
                'teams' => 'AC Milan vs Inter Milan',
                'match_date' => Carbon::now()->addDays(33)->setHour(20)->setMinute(45),
                'venue' => 'San Siro, Milan',
                'available_seats' => 850,
                'ticket_price' => 1300000,
                'description' => 'Derby della Madonnina mempertemukan dua klub sekota Milan dalam pertandingan yang selalu penuh gengsi, emosi, dan kualitas permainan top.',
            ],
            [
                'title' => 'Bundesliga: Bayern Munich vs Borussia Dortmund',
                'teams' => 'Bayern Munich vs Borussia Dortmund',
                'match_date' => Carbon::now()->addDays(25)->setHour(18)->setMinute(30),
                'venue' => 'Allianz Arena, Munich',
                'available_seats' => 920,
                'ticket_price' => 1150000,
                'description' => 'Der Klassiker antara dua kekuatan besar Bundesliga yang selalu menawarkan pertandingan menarik dengan tempo tinggi dan banyak gol.',
            ],
            [
                'title' => 'Ligue 1: PSG vs Marseille',
                'teams' => 'Paris Saint-Germain vs Olympique Marseille',
                'match_date' => Carbon::now()->addDays(40)->setHour(19)->setMinute(00),
                'venue' => 'Parc des Princes, Paris',
                'available_seats' => 780,
                'ticket_price' => 1250000,
                'description' => 'Le Classique mempertemukan dua rival abadi dari utara dan selatan Prancis dalam pertandingan yang selalu penuh tensi dan kualitas.',
            ]
        ];

        foreach ($matches as $match) {
            Matches::create($match);
        }
    }
}