@extends('layouts.app')
@section('title', 'Book ' . $room->name)

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 6rem;">
        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('rooms.index') }}">Rooms</a></li>
                <li><a href="{{ route('rooms.show', $room) }}">{{ $room->name }}</a></li>
                <li aria-current="page">Book</li>
            </ol>
        </nav>

        <div class="booking-layout">
            <div class="booking-form-section">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                    <span
                        style="display: block; width: 48px; height: 1.5px; background-color: var(--color-primary);"></span>
                    <span class="label-caps" style="color: var(--color-primary);">Reservation</span>
                </div>
                <h1 class="display-medium" style="margin-bottom: 2.5rem; text-wrap: balance;">Book Your Stay</h1>

                <form method="POST" action="{{ route('bookings.store') }}" id="booking-form">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">

                    <div class="form-group">
                        <label for="check_in" class="form-label">Check-in Date</label>
                        <input type="date" name="check_in" id="check_in" required min="{{ date('Y-m-d') }}"
                            value="{{ old('check_in') }}" class="form-control @error('check_in') is-invalid @enderror"
                            autocomplete="off">
                        @error('check_in')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="check_out" class="form-label">Check-out Date</label>
                        <input type="date" name="check_out" id="check_out" required
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('check_out') }}"
                            class="form-control @error('check_out') is-invalid @enderror" autocomplete="off">
                        @error('check_out')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="guests" class="form-label">Number of Guests</label>
                        <input type="number" name="guests" id="guests" required min="1" max="{{ $room->capacity }}"
                            value="{{ old('guests', 1) }}" class="form-control @error('guests') is-invalid @enderror"
                            inputmode="numeric" autocomplete="off">
                        <span class="form-hint">Maximum {{ $room->capacity }}
                            {{ Str::plural('guest', $room->capacity) }}</span>
                        @error('guests')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="notes" class="form-label">Special Requests <span
                                style="font-weight: 400; text-transform: none; letter-spacing: 0; font-size: 0.85rem; color: var(--color-text-muted);">(optional)</span></label>
                        <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror"
                            placeholder="Any special requests or notes…" spellcheck="true"
                            autocomplete="off">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="price-summary" id="price-summary" aria-live="polite"
                        style="font-variant-numeric: tabular-nums;">
                        <div class="price-row">
                            <span>Price per night</span>
                            <span>Rp {{ number_format($room->price_per_night, 0, ',', '.') }}</span>
                        </div>
                        <div class="price-row">
                            <span>Nights</span>
                            <span id="nights-count">0</span>
                        </div>
                        <div class="price-row price-total">
                            <span>Total</span>
                            <span id="total-price">Rp 0</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; padding: 0.875rem; font-size: 0.95rem;">
                        Confirm Booking
                    </button>
                </form>
            </div>

            <aside class="booking-room-summary">
                <div class="summary-card">
                    <div class="summary-image">
                        @if($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" width="400" height="250"
                                loading="lazy">
                        @else
                            <div class="room-card-placeholder" aria-hidden="true"><span>🛏️</span></div>
                        @endif
                    </div>
                    <div class="summary-details">
                        <span class="room-badge">{{ ucfirst($room->type) }}</span>
                        <h3>{{ $room->name }}</h3>
                        <p>{{ Str::limit($room->description, 100) }}</p>
                        <div class="detail-feature">
                            <i class="ph ph-users" aria-hidden="true"></i>
                            <span>Up to {{ $room->capacity }} guests</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    @push('scripts')
        <script>
            (function () {
                const pricePerNight = {{ $room->price_per_night }};
                const checkInEl = document.getElementById('check_in');
                const checkOutEl = document.getElementById('check_out');
                const nightsEl = document.getElementById('nights-count');
                const totalEl = document.getElementById('total-price');

                function updatePrice() {
                    const checkIn = new Date(checkInEl.value);
                    const checkOut = new Date(checkOutEl.value);

                    if (checkInEl.value && checkOutEl.value && checkOut > checkIn) {
                        const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
                        const total = nights * pricePerNight;
                        nightsEl.textContent = nights;
                        totalEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
                    } else {
                        nightsEl.textContent = '0';
                        totalEl.textContent = 'Rp 0';
                    }
                }

                checkInEl.addEventListener('change', function () {
                    const nextDay = new Date(this.value);
                    nextDay.setDate(nextDay.getDate() + 1);
                    checkOutEl.min = nextDay.toISOString().split('T')[0];
                    if (checkOutEl.value && new Date(checkOutEl.value) <= new Date(this.value)) {
                        checkOutEl.value = nextDay.toISOString().split('T')[0];
                    }
                    updatePrice();
                });

                checkOutEl.addEventListener('change', updatePrice);
                updatePrice();
            })();
        </script>
    @endpush
@endsection