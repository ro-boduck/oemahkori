<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Request $request, Room $room)
    {
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        $room = Room::findOrFail($validated['room_id']);

        // Check capacity
        if ($validated['guests'] > $room->capacity) {
            return back()->withErrors(['guests' => "This room accommodates a maximum of {$room->capacity} guests."])->withInput();
        }

        // Check availability
        if (!$room->isAvailableForDates($validated['check_in'], $validated['check_out'])) {
            return back()->withErrors(['check_in' => 'This room is not available for the selected dates.'])->withInput();
        }

        // Calculate price
        $checkIn = \Carbon\Carbon::parse($validated['check_in']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out']);
        $nights = $checkIn->diffInDays($checkOut);
        $totalPrice = $nights * $room->price_per_night;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $room->id,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'total_price' => $totalPrice,
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('my-bookings')->with('success', 'Booking created successfully! Your booking is pending confirmation.');
    }

    public function myBookings()
    {
        $bookings = auth()->user()->bookings()
            ->with('room')
            ->orderByDesc('created_at')
            ->get();

        return view('bookings.my', compact('bookings'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return back()->withErrors(['status' => 'This booking cannot be cancelled.']);
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
