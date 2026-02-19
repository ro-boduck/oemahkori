@extends('layouts.app')
@section('title', 'My Bookings')

@section('content')
    <div class="container" style="padding-top: 4rem; padding-bottom: 8rem; max-width: 900px;">
        <header style="margin-bottom: 3rem; text-align: center;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; margin-bottom: 1rem;">
                <span style="display: block; width: 48px; height: 1.5px; background-color: var(--color-primary);"></span>
                <span class="label-caps" style="color: var(--color-primary); letter-spacing: 0.1em;">Account</span>
                <span style="display: block; width: 48px; height: 1.5px; background-color: var(--color-primary);"></span>
            </div>
            <h1 class="display-medium" style="margin-bottom: 0.75rem; text-wrap: balance;">My Bookings</h1>
            <p style="color: var(--color-text-secondary); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Manage your
                upcoming stays and view your booking history.</p>
        </header>

        @if($bookings->isEmpty())
            <div class="empty-state"
                style="text-align: center; padding: 4rem 2rem; background: var(--color-surface); border-radius: var(--radius-lg); border: 1px solid var(--color-border);">
                <div style="font-size: 4rem; margin-bottom: 1.5rem; color: var(--color-primary-muted); opacity: 0.5;">
                    <i class="ph ph-suitcase-rolling"></i>
                </div>
                <h2 style="font-family: var(--font-heading); font-size: 1.5rem; margin-bottom: 0.5rem;">No Bookings Found</h2>
                <p style="color: var(--color-text-secondary); margin-bottom: 2rem;">You haven't made any reservations yet. Your
                    next getaway is just a click away.</p>
                <a href="{{ route('rooms.index') }}" class="btn btn-primary">
                    Browse Rooms
                </a>
            </div>
        @else
            <div class="bookings-list" style="display: grid; gap: 1.5rem;">
                @foreach($bookings as $booking)
                    <article class="booking-card"
                        style="background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-lg); overflow: hidden; display: grid; grid-template-columns: 200px 1fr auto; gap: 1.5rem; padding: 0;">

                        {{-- Booking Image --}}
                        <div class="booking-image" style="background: var(--color-surface-alt); position: relative;">
                            @if($booking->room->image)
                                <img src="{{ asset('storage/' . $booking->room->image) }}" alt="{{ $booking->room->name }}"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div
                                    style="display: flex; align-items: center; justify-content: center; height: 100%; color: var(--color-text-muted); font-size: 2rem;">
                                    <i class="ph ph-image"></i>
                                </div>
                            @endif
                            <div
                                style="position: absolute; top: 0.75rem; left: 0.75rem; background: rgba(255,255,255,0.9); padding: 0.25rem 0.6rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">
                                {{ ucfirst($booking->room->type) }}
                            </div>
                        </div>

                        {{-- Booking Details --}}
                        <div class="booking-details"
                            style="padding: 1.5rem 0; display: flex; flex-direction: column; justify-content: center;">
                            <div style="margin-bottom: 0.5rem;">
                                <span
                                    style="font-size: 0.8rem; letter-spacing: 0.05em; text-transform: uppercase; color: var(--color-text-muted);">Booking
                                    #{{ $booking->id }}</span>
                            </div>
                            <h3
                                style="font-family: var(--font-heading); font-size: 1.4rem; margin-bottom: 1rem; color: var(--color-primary);">
                                {{ $booking->room->name }}</h3>

                            <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <i class="ph ph-calendar-blank" style="font-size: 1.2rem; color: var(--color-primary);"></i>
                                    <div>
                                        <div
                                            style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted);">
                                            Check-in</div>
                                        <div style="font-weight: 500;">{{ $booking->check_in->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <i class="ph ph-calendar-check" style="font-size: 1.2rem; color: var(--color-primary);"></i>
                                    <div>
                                        <div
                                            style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted);">
                                            Check-out</div>
                                        <div style="font-weight: 500;">{{ $booking->check_out->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.6rem;">
                                    <i class="ph ph-users" style="font-size: 1.2rem; color: var(--color-primary);"></i>
                                    <div>
                                        <div
                                            style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-text-muted);">
                                            Guests</div>
                                        <div style="font-weight: 500;">{{ $booking->guests }} People</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Booking Status & Actions --}}
                        <div class="booking-status"
                            style="padding: 1.5rem; background: var(--color-surface-hover); display: flex; flex-direction: column; justify-content: center; min-width: 220px; text-align: right;">
                            <div style="margin-bottom: auto;">
                                <span class="status-badge status-{{ $booking->status }}"
                                    style="display: inline-block; padding: 0.3rem 0.8rem; border-radius: 999px; font-size: 0.85rem; font-weight: 600; text-transform: capitalize;">
                                    {{ $booking->status }}
                                </span>
                            </div>

                            <div style="margin-top: 1rem; margin-bottom: 1rem;">
                                <div style="font-size: 0.8rem; color: var(--color-text-muted);">Total Price</div>
                                <div
                                    style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 600; color: var(--color-primary);">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </div>
                            </div>

                            @if(in_array($booking->status, ['pending', 'confirmed']))
                                <form method="POST" action="{{ route('bookings.cancel', $booking) }}"
                                    onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline btn-sm"
                                        style="width: 100%; border-color: #EF4444; color: #EF4444; font-size: 0.85rem;">
                                        Cancel Booking
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('rooms.show', $booking->room) }}" class="btn btn-outline btn-sm"
                                    style="width: 100%; justify-content: center;">
                                    Book Again
                                </a>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        /* Responsive adjustments for booking card */
        @media (max-width: 768px) {
            .booking-card {
                grid-template-columns: 1fr !important;
                grid-template-rows: 200px auto auto;
            }

            .booking-details {
                padding: 1rem 1.5rem !important;
            }

            .booking-status {
                text-align: left !important;
                flex-direction: row !important;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .booking-status>div {
                margin: 0 !important;
            }

            .booking-status form,
            .booking-status a {
                width: auto !important;
            }
        }
    </style>
@endsection