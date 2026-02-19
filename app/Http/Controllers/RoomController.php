<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::available();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('min_price')) {
            $query->where('price_per_night', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_night', '<=', $request->max_price);
        }

        if ($request->filled('capacity')) {
            $query->where('capacity', '>=', $request->capacity);
        }

        $rooms = $query->orderBy('price_per_night')->get();
        // Fetch distinct room types for the filter
        $roomTypes = Room::select('type')->distinct()->get();

        return view('rooms.index', compact('rooms', 'roomTypes'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }
}
