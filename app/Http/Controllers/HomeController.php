<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredRooms = Room::available()->take(3)->get();
        $roomTypes = Room::available()
            ->selectRaw('type, COUNT(*) as count, MIN(price_per_night) as min_price')
            ->groupBy('type')
            ->get();

        return view('home', compact('featuredRooms', 'roomTypes'));
    }
}
