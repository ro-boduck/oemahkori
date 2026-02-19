@extends('layouts.app')

@section('title', $room->name)

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 6rem;">
        {{-- Breadcrumb --}}
        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" style="margin-bottom: 2rem;">
            <ol
                style="list-style: none; padding: 0; margin: 0; display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; color: var(--color-text-secondary);">
                <li>
                    <a href="{{ route('home') }}"
                        style="color: var(--color-text-secondary); text-decoration: none; transition: color 0.2s;"
                        onmouseover="this.style.color='var(--color-primary)'"
                        onmouseout="this.style.color='var(--color-text-secondary)'">Home</a>
                </li>
                <li><i class="ph ph-caret-right" aria-hidden="true"
                        style="font-size: 0.8rem; color: var(--color-text-muted);"></i></li>
                <li>
                    <a href="{{ route('rooms.index') }}"
                        style="color: var(--color-text-secondary); text-decoration: none; transition: color 0.2s;"
                        onmouseover="this.style.color='var(--color-primary)'"
                        onmouseout="this.style.color='var(--color-text-secondary)'">Rooms</a>
                </li>
                <li><i class="ph ph-caret-right" aria-hidden="true"
                        style="font-size: 0.8rem; color: var(--color-text-muted);"></i></li>
                <li aria-current="page" style="color: var(--color-text); font-weight: 500;">{{ $room->name }}</li>
            </ol>
        </nav>

        <div style="display: grid; grid-template-columns: 1fr; gap: 3rem;" class="room-layout">
            {{-- Left Column: Gallery & Story --}}
            <div style="space-y: 3rem;">
                {{-- Hero Image --}}
                <div style="aspect-ratio: 16/9; overflow: hidden; position: relative; margin-bottom: 3rem;">
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}"
                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);"
                            loading="eager" fetchpriority="high" width="800" height="450"
                            onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                    @else
                        <div
                            style="width: 100%; height: 100%; background: var(--color-bg-alt); display: flex; align-items: center; justify-content: center; color: var(--color-text-muted);">
                            <span style="font-family: var(--font-heading); font-size: 1.5rem;">Image Coming Soon</span>
                        </div>
                    @endif

                    <span class="room-badge"
                        style="position: absolute; top: 1.5rem; left: 1.5rem; background: rgba(250, 249, 245, 0.95); backdrop-filter: blur(8px);">
                        {{ $room->type }} Collection
                    </span>
                </div>

                {{-- Room Title & Intro --}}
                <div style="margin-bottom: 2.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                        <span
                            style="display: block; width: 48px; height: 1.5px; background-color: var(--color-primary);"></span>
                        <span class="label-caps" style="color: var(--color-primary);">{{ $room->type }} Room</span>
                    </div>
                    <h1 class="display-large" style="margin-bottom: 1.5rem;">{{ $room->name }}</h1>
                    <blockquote
                        style="font-size: 1.15rem; color: var(--color-text-secondary); font-style: italic; line-height: 1.7; padding-left: 1.5rem; border-left: 2px solid var(--color-primary); margin: 0;">
                        "A sanctuary designed for stillness, where every detail invites you to pause."
                    </blockquote>
                </div>

                {{-- Full Description --}}
                <div style="margin-bottom: 3rem;">
                    <p
                        style="font-size: 1.05rem; color: var(--color-text-secondary); line-height: 1.8; margin-bottom: 1.5rem;">
                        {{ $room->description }}
                    </p>
                    <p style="font-size: 1.05rem; color: var(--color-text-secondary); line-height: 1.8;">
                        Wake up to the gentle rustling of palm leaves and the soft morning light filtering through
                        handcrafted timber louvers. This room is more than just a place to sleep—it's a private retreat
                        curated for mindfulness and comfort.
                    </p>
                </div>

                {{-- Amenities Grid --}}
                <div
                    style="padding: 3rem; background-color: var(--color-surface); border: 1px solid var(--color-border-light);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
                        <h3
                            style="font-family: var(--font-heading); font-size: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                            <i class="ph ph-sparkle" style="color: var(--color-primary);" aria-hidden="true"></i>
                            Room Amenities
                        </h3>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
                        {{-- Comfort --}}
                        <div>
                            <span class="label-caps"
                                style="display: block; margin-bottom: 1rem; color: var(--color-text-muted);">Comfort</span>
                            <ul
                                style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                                <li
                                    style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-secondary);">
                                    <i class="ph ph-bed" aria-hidden="true"
                                        style="font-size: 1.1rem; color: var(--color-primary);"></i>
                                    <span>{{ ($room->type == 'deluxe' || $room->type == 'suite') ? 'King Size Bed' : 'Queen Size Bed' }}</span>
                                </li>
                                <li
                                    style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-secondary);">
                                    <i class="ph ph-fan" aria-hidden="true"
                                        style="font-size: 1.1rem; color: var(--color-primary);"></i>
                                    <span>AC & Ceiling Fan</span>
                                </li>
                                <li
                                    style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-secondary);">
                                    <i class="ph ph-couch" aria-hidden="true"
                                        style="font-size: 1.1rem; color: var(--color-primary);"></i>
                                    <span>Lounge Area</span>
                                </li>
                            </ul>
                        </div>

                        {{-- Tech & Work --}}
                        <div>
                            <span class="label-caps"
                                style="display: block; margin-bottom: 1rem; color: var(--color-text-muted);">Tech &
                                Work</span>
                            <ul
                                style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                                <li
                                    style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-secondary);">
                                    <i class="ph ph-wifi-high" aria-hidden="true"
                                        style="font-size: 1.1rem; color: var(--color-primary);"></i>
                                    <span>High-Speed Fiber</span>
                                </li>
                                <li
                                    style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-secondary);">
                                    <i class="ph ph-desktop" aria-hidden="true"
                                        style="font-size: 1.1rem; color: var(--color-primary);"></i>
                                    <span>Workspace Desk</span>
                                </li>
                            </ul>
                        </div>

                        {{-- Bath & Refresh --}}
                        <div>
                            <span class="label-caps"
                                style="display: block; margin-bottom: 1rem; color: var(--color-text-muted);">Bath &
                                Refresh</span>
                            <ul
                                style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                                <li
                                    style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-secondary);">
                                    <i class="ph ph-shower" aria-hidden="true"
                                        style="font-size: 1.1rem; color: var(--color-primary);"></i>
                                    <span>Rain Shower</span>
                                </li>
                                <li
                                    style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-secondary);">
                                    <i class="ph ph-coffee" aria-hidden="true"
                                        style="font-size: 1.1rem; color: var(--color-primary);"></i>
                                    <span>Coffee Maker</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Booking Widget --}}
            <div>
                <div class="booking-widget-sticky" style="position: sticky; top: 88px;">
                    <div
                        style="background: var(--color-surface); padding: 2rem; border: 1px solid var(--color-border-light);">
                        <div
                            style="text-align: center; margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--color-border-light);">
                            <span class="label-caps" style="display: block; margin-bottom: 0.75rem;">Starting From</span>
                            <div style="display: flex; justify-content: center; align-items: baseline; gap: 0.25rem;">
                                <span style="font-size: 0.85rem; color: var(--color-text-muted);">IDR</span>
                                <span
                                    style="font-size: 2.5rem; font-weight: 700; font-family: var(--font-heading); color: var(--color-text); font-variant-numeric: tabular-nums;">{{ number_format($room->price_per_night, 0, ',', '.') }}</span>
                            </div>
                            <span style="font-size: 0.8rem; color: var(--color-text-muted);">per night</span>
                        </div>

                        <form action="{{ route('bookings.create', $room) }}" method="GET">
                            <input type="hidden" name="room_id" value="{{ $room->id }}">

                            <div style="margin-bottom: 1.25rem;">
                                <label class="form-label">Check Availability</label>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                                    <input type="date" name="check_in" required class="form-control"
                                        style="font-size: 0.85rem; padding: 0.75rem;" autocomplete="off">
                                    <input type="date" name="check_out" required class="form-control"
                                        style="font-size: 0.85rem; padding: 0.75rem;" autocomplete="off">
                                </div>
                            </div>

                            <div style="margin-bottom: 1.5rem;">
                                <label class="form-label">Guests</label>
                                <select name="guests" class="form-control"
                                    style="font-size: 0.85rem; padding: 0.75rem; cursor: pointer;">
                                    @for($i = 1; $i <= $room->capacity; $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ Str::plural('Guest', $i) }}</option>
                                    @endfor
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary"
                                style="width: 100%; padding: 0.875rem; font-size: 0.95rem;">
                                Reserve Your Spot
                            </button>

                            <p
                                style="text-align: center; font-size: 0.8rem; color: var(--color-text-muted); margin-top: 1rem; display: flex; align-items: center; justify-content: center; gap: 0.375rem;">
                                <i class="ph-fill ph-check-circle" style="color: #059669;" aria-hidden="true"></i>
                                Free cancellation up to 48 hours
                            </p>
                        </form>
                    </div>

                    {{-- WhatsApp help --}}
                    <div
                        style="margin-top: 1.5rem; text-align: center; padding: 1.25rem; border: 1px solid var(--color-border-light);">
                        <p style="font-size: 0.9rem; font-weight: 500; margin-bottom: 0.375rem;">Have questions?</p>
                        <a href="https://wa.me/6281997186379" target="_blank" rel="noopener"
                            style="font-size: 0.9rem; color: var(--color-primary); display: flex; align-items: center; justify-content: center; gap: 0.5rem; text-decoration: none; transition: opacity 0.2s;"
                            onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                            <i class="ph ph-whatsapp-logo" style="font-size: 1.1rem;" aria-hidden="true"></i>
                            Chat with us on WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Guest Reviews Widget --}}
        <div style="margin-top: 6rem; padding-top: 4rem; border-top: 1px solid var(--color-border);">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem;">
                <h3 class="display-small">Guest Experiences</h3>
            </div>

            <div
                style="background: white; border: 1px solid #e0e0e0; border-radius: 8px; padding: 3rem; box-shadow: 0 4px 12px rgba(0,0,0,0.05); width: 100%;">
                <div class="review-grid"
                    style="display: grid; grid-template-columns: 1fr 2fr; gap: 3rem; align-items: center;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg"
                                alt="Google" style="width: 32px; height: 32px;">
                            <div>
                                <div
                                    style="display: flex; align-items: center; gap: 0.25rem; color: #fbbf24; font-size: 1.1rem;">
                                    <i class="ph-fill ph-star"></i>
                                    <i class="ph-fill ph-star"></i>
                                    <i class="ph-fill ph-star"></i>
                                    <i class="ph-fill ph-star"></i>
                                    <i class="ph-fill ph-star"></i>
                                </div>
                                <span
                                    style="font-size: 0.95rem; color: var(--color-text-secondary); font-weight: 500; margin-top: 0.25rem; display: block;">5.0/5.0
                                    based on 128 reviews</span>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="width: 48px; height: 48px; background-color: var(--color-primary-muted); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--color-primary); font-weight: 700; font-size: 1.1rem;">
                                S
                            </div>
                            <div>
                                <span style="display: block; font-weight: 600; font-size: 1rem;">Sarah Jenkins</span>
                                <span style="font-size: 0.85rem; color: var(--color-text-muted);">2 weeks ago on
                                    Google</span>
                            </div>
                        </div>
                    </div>

                    <div class="review-quote" style="border-left: 1px solid var(--color-border-light); padding-left: 3rem;">
                        <p
                            style="font-family: var(--font-heading); font-size: 1.25rem; font-style: italic; color: var(--color-text); line-height: 1.6; margin-bottom: 2rem;">
                            "An absolute gem in the heart of Bali. The attention to detail is unmatched, and the peaceful
                            atmosphere is exactly what we needed."
                        </p>

                        <a href="#" target="_blank"
                            style="font-size: 0.95rem; font-weight: 600; color: var(--color-primary); text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                            Read all reviews on Google
                            <i class="ph ph-arrow-square-out"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            @media (min-width: 1024px) {
                .room-layout {
                    grid-template-columns: 1fr 380px !important;
                }
            }
        </style>
    @endpush
@endsection