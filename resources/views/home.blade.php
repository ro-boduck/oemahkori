@extends('layouts.app')

@section('title', 'A Sanctuary in Bali')

@section('content')
    {{-- Hero Section — Editorial, full-width, content-driven --}}
    <section style="position: relative; padding: clamp(4rem, 10vw, 8rem) 0 clamp(3rem, 6vw, 6rem); overflow: hidden;">
        {{-- Subtle warm glow --}}
        <div style="position: absolute; top: -20%; right: -10%; width: 600px; height: 600px; background: var(--color-primary); opacity: 0.04; border-radius: 50%; filter: blur(120px); pointer-events: none;"
            aria-hidden="true"></div>
        <div style="position: absolute; bottom: -20%; left: -10%; width: 500px; height: 500px; background: var(--color-bg-alt); opacity: 0.5; border-radius: 50%; filter: blur(100px); pointer-events: none;"
            aria-hidden="true"></div>

        {{-- Hero Batik Accent --}}
        <div class="batik-pattern"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.04; pointer-events: none; mask-image: linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0)); -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0));"
            aria-hidden="true"></div>

        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr; gap: 4rem; align-items: center;" class="hero-grid">
                {{-- Text content --}}
                <div class="reveal-on-scroll" style="max-width: 720px;">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem;">
                        <span
                            style="display: block; width: 48px; height: 1.5px; background-color: var(--color-primary);"></span>
                        <span class="label-caps" style="color: var(--color-primary);">Bali, Indonesia</span>
                    </div>

                    <h1 class="display-hero" style="margin-bottom: 2rem;">
                        Serenity found<br>
                        <span style="color: var(--color-primary); font-style: italic;">in paradise.</span>
                    </h1>

                    <p class="text-lead" style="max-width: 520px; margin-bottom: 3rem;">
                        A curated sanctuary where modern comfort meets the timeless spirit of Bali.
                        Experience the art of slow living in our intimate guest house.
                    </p>

                    <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 4rem;">
                        <a href="{{ route('rooms.index') }}" class="btn btn-primary">
                            Book Your Stay
                        </a>
                        <a href="#featured" class="btn btn-outline">
                            Explore Spaces
                        </a>
                    </div>

                    {{-- Feature strip — minimal icons --}}
                    <div
                        style="display: flex; flex-wrap: wrap; gap: 2.5rem; padding-top: 2rem; border-top: 1px solid var(--color-border);">
                        <div
                            style="display: flex; align-items: center; gap: 0.5rem; color: var(--color-text-muted); font-size: 0.85rem;">
                            <i class="ph ph-wifi-high" style="font-size: 1.1rem;" aria-hidden="true"></i>
                            <span>High-Speed Wifi</span>
                        </div>
                        <div
                            style="display: flex; align-items: center; gap: 0.5rem; color: var(--color-text-muted); font-size: 0.85rem;">
                            <i class="ph ph-plant" style="font-size: 1.1rem;" aria-hidden="true"></i>
                            <span>Tropical Gardens</span>
                        </div>
                        <div
                            style="display: flex; align-items: center; gap: 0.5rem; color: var(--color-text-muted); font-size: 0.85rem;">
                            <i class="ph ph-coffee" style="font-size: 1.1rem;" aria-hidden="true"></i>
                            <span>Daily Breakfast</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Hero Image Row — Asymmetric layout --}}
            <div style="margin-top: 4rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; max-height: 480px;"
                class="reveal-on-scroll delay-200 hero-images">
                <div style="overflow: hidden; border-radius: 16px 0 0 0;">
                    <img src="{{ asset('images/hero-exterior.jpg') }}" alt="OemahKori tropical sanctuary exterior"
                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);"
                        loading="eager" fetchpriority="high" onmouseover="this.style.transform='scale(1.03)'"
                        onmouseout="this.style.transform='scale(1)'">
                </div>
                <div style="overflow: hidden; border-radius: 0 0 16px 0; position: relative;">
                    <img src="{{ asset('images/hero-interior.jpg') }}" alt="OemahKori exterior detail"
                        style="width: 100%; height: 100%; object-fit: cover; object-position: center right; filter: brightness(0.95); transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);"
                        loading="eager" onmouseover="this.style.transform='scale(1.03)'"
                        onmouseout="this.style.transform='scale(1)'">
                    {{-- Floating badge --}}
                    <div class="animate-float"
                        style="position: absolute; bottom: 1.5rem; left: 1.5rem; background: var(--color-surface); padding: 1rem 1.5rem; display: flex; align-items: center; gap: 0.75rem; box-shadow: var(--shadow-card);">
                        <div
                            style="width: 40px; height: 40px; background: var(--color-primary-muted); display: flex; align-items: center; justify-content: center; border-radius: 8px 0 0 8px;">
                            <i class="ph ph-star-four" style="font-size: 1.25rem; color: var(--color-primary);"
                                aria-hidden="true"></i>
                        </div>
                        <div>
                            <p
                                style="font-family: var(--font-heading); font-size: 1rem; font-weight: 600; line-height: 1.2; margin: 0;">
                                Top Rated</p>
                            <p style="font-size: 0.8rem; color: var(--color-text-muted); margin: 0;">"An unforgettable
                                escape."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Rooms Section --}}
    <section id="featured" class="section-padding">
        <div class="container">
            <div class="reveal-on-scroll"
                style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1rem; margin-bottom: 4rem;">
                <div>
                    <span class="label-caps"
                        style="display: block; margin-bottom: 0.75rem; color: var(--color-primary);">Featured</span>
                    <h2 class="display-large">Curated Spaces</h2>
                </div>
                <a href="{{ route('rooms.index') }}" class="btn-text group"
                    style="display: flex; align-items: center; gap: 0.5rem;">
                    View All Rooms
                    <i class="ph ph-arrow-right" style="transition: transform 0.2s;" aria-hidden="true"></i>
                </a>
            </div>

            {{-- Room Cards — Editorial grid --}}
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 2rem;">
                @foreach($featuredRooms as $index => $room)
                    <article class="card reveal-on-scroll delay-{{ ($index + 1) * 100 }}"
                        style="border-radius: 0; border: none; border-bottom: 2px solid var(--color-border); background: transparent; transition: all 0.4s ease;">
                        {{-- Image --}}
                        <div style="aspect-ratio: 4/3; overflow: hidden; position: relative;">
                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}"
                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);"
                                loading="lazy" width="400" height="300" onmouseover="this.style.transform='scale(1.05)'"
                                onmouseout="this.style.transform='scale(1)'">

                            <span class="room-badge"
                                style="position: absolute; top: 1rem; left: 1rem; background: rgba(250, 249, 245, 0.95); backdrop-filter: blur(8px);">
                                {{ $room->type }}
                            </span>
                        </div>

                        {{-- Content --}}
                        <div style="padding: 2.5rem 1.5rem;">
                            <div
                                style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                                <h3 style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 600;">
                                    {{ $room->name }}
                                </h3>
                                <div style="text-align: right; flex-shrink: 0; padding-left: 1rem;">
                                    <span style="font-size: 1.25rem; font-weight: 700; color: var(--color-primary);">
                                        IDR {{ number_format($room->price_per_night / 1000, 0) }}k
                                    </span>
                                    <span style="display: block; font-size: 0.75rem; color: var(--color-text-muted);">/
                                        night</span>
                                </div>
                            </div>

                            <p
                                style="font-size: 0.9rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $room->description }}
                            </p>

                            <div
                                style="display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid var(--color-border-light); font-size: 0.85rem; color: var(--color-text-muted);">
                                <div style="display: flex; gap: 1.5rem;">
                                    <span style="display: flex; align-items: center; gap: 0.375rem;">
                                        <i class="ph ph-users" aria-hidden="true"></i> {{ $room->capacity }} Guests
                                    </span>
                                    <span style="display: flex; align-items: center; gap: 0.375rem;">
                                        <i class="ph ph-bed" aria-hidden="true"></i>
                                        {{ $room->type === 'deluxe' ? 'King' : 'Queen' }}
                                    </span>
                                </div>
                                <a href="{{ route('rooms.show', $room) }}"
                                    style="color: var(--color-text); font-weight: 500; display: flex; align-items: center; gap: 0.375rem; transition: color 0.2s;"
                                    onmouseover="this.style.color='var(--color-primary)'"
                                    onmouseout="this.style.color='var(--color-text)'">
                                    View <i class="ph ph-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Story Section — Full-width editorial band --}}
    <section style="background-color: var(--color-accent); color: var(--color-surface); padding: 6rem 0; margin: 4rem 0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr; gap: 4rem; align-items: center;" class="story-grid">
                <div class="reveal-on-scroll">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem;">
                        <span
                            style="display: block; width: 48px; height: 1.5px; background-color: var(--color-primary);"></span>
                        <span class="label-caps" style="color: var(--color-primary);">The Story</span>
                    </div>

                    <h2 class="display-large" style="color: var(--color-surface); margin-bottom: 1.5rem;">
                        Rooted in tradition,<br>designed for peace.
                    </h2>

                    <p
                        style="font-size: 1.15rem; color: rgba(250, 249, 245, 0.7); line-height: 1.8; max-width: 600px; margin-bottom: 3rem;">
                        OemahKori is a living gallery of Balinese heritage. Constructed from locally sourced teak and
                        volcanic
                        stone, every corner tells a story of craftsmanship and nature.
                    </p>

                    <div
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 3rem; max-width: 400px;">
                        <div>
                            <span
                                style="display: block; font-family: var(--font-heading); font-size: 3rem; font-weight: 700; color: var(--color-primary); line-height: 1;">100%</span>
                            <span
                                style="font-size: 0.85rem; color: rgba(250, 249, 245, 0.5); margin-top: 0.25rem; display: block;">Locally
                                Sourced Materials</span>
                        </div>
                        <div>
                            <span
                                style="display: block; font-family: var(--font-heading); font-size: 3rem; font-weight: 700; color: var(--color-primary); line-height: 1;">0%</span>
                            <span
                                style="font-size: 0.85rem; color: rgba(250, 249, 245, 0.5); margin-top: 0.25rem; display: block;">Plastic
                                Waste Policy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Local Guide Section --}}
    <section class="section-padding"
        style="position: relative; overflow: hidden; background: linear-gradient(to bottom, var(--color-bg), var(--color-bg-alt));">
        <div class="container">
            <div class="reveal-on-scroll" style="text-align: center; margin-bottom: 4rem;">
                <span class="label-caps"
                    style="display: block; margin-bottom: 1rem; color: var(--color-primary);">Discover</span>
                <h2 class="display-large">Nearest Attractions</h2>
                <p style="color: var(--color-text-secondary); max-width: 540px; margin: 0 auto; margin-top: 1rem;">
                    From cultural landmarks to pristine beaches, the best of Bali is within reach.
                </p>
            </div>

            <div style="position: relative; padding: 0 1rem; max-width: 1200px; margin: 0 auto;">
                {{-- Carousel Buttons (Absolute Positioned) --}}
                <button
                    onclick="const c = document.getElementById('attractions-carousel'); const w = c.firstElementChild.offsetWidth + 32; c.scrollBy({left: -w, behavior: 'smooth'})"
                    class="btn-outline carousel-btn"
                    style="position: absolute; top: 50%; left: -2rem; transform: translateY(-50%); z-index: 10; width: 48px; height: 48px; padding: 0; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: white; border: 1px solid var(--color-border-light); color: var(--color-text); box-shadow: 0 4px 12px rgba(0,0,0,0.1); cursor: pointer;">
                    <i class="ph ph-caret-left" aria-hidden="true" style="font-size: 1.5rem;"></i>
                </button>
                <button
                    onclick="const c = document.getElementById('attractions-carousel'); const w = c.firstElementChild.offsetWidth + 32; c.scrollBy({left: w, behavior: 'smooth'})"
                    class="btn-outline carousel-btn"
                    style="position: absolute; top: 50%; right: -2rem; transform: translateY(-50%); z-index: 10; width: 48px; height: 48px; padding: 0; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: white; border: 1px solid var(--color-border-light); color: var(--color-text); box-shadow: 0 4px 12px rgba(0,0,0,0.1); cursor: pointer;">
                    <i class="ph ph-caret-right" aria-hidden="true" style="font-size: 1.5rem;"></i>
                </button>

                {{-- Carousel Container --}}
                <div id="attractions-carousel"
                    style="display: flex; gap: 2rem; overflow-x: auto; scroll-snap-type: x mandatory; padding: 4rem 0.5rem; scroll-behavior: smooth; -webkit-overflow-scrolling: touch; scrollbar-width: none; -ms-overflow-style: none;">
                    @php
                        $base_attractions = [
                            [
                                'name' => 'Garuda Wisnu Kencana (GWK)',
                                'distance' => '2.5 km',
                                'time' => '7 - 10 mins',
                                'description' => 'Iconic cultural park featuring a colossal statue of Vishnu riding Garuda.'
                            ],
                            [
                                'name' => 'Jimbaran Beach',
                                'distance' => '3.2 km',
                                'time' => '10 - 12 mins',
                                'description' => 'Famous for its stunning sunsets and fresh seafood dining on the sand.'
                            ],
                            [
                                'name' => 'Tegal Wangi Beach',
                                'distance' => '5.0 km',
                                'time' => '15 - 20 mins',
                                'description' => 'A hidden gem known for its natural rock pools and panoramic ocean views.'
                            ],
                            [
                                'name' => 'ITDC Nusa Dua',
                                'distance' => '10.5 km',
                                'time' => '20 - 25 mins',
                                'description' => 'World-class tourism complex with pristine gardens and water sports.'
                            ],
                            [
                                'name' => 'Uluwatu Temple',
                                'distance' => '11.7 km',
                                'time' => '30 - 35 mins',
                                'description' => 'Majestic sea temple perched on a cliff, famous for its Kecak fire dance.'
                            ],
                        ];
                        // Duplicate for looping effect (6x to simulate infinite)
                        $attractions = array_merge($base_attractions, $base_attractions, $base_attractions, $base_attractions, $base_attractions, $base_attractions);
                    @endphp

                    @foreach($attractions as $index => $attraction)
                        <div class="reveal-on-scroll attraction-card"
                            style="min-width: 0; flex: 0 0 calc((100% - 4rem) / 3); scroll-snap-align: center; background: white; padding: 2.5rem 2rem; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: flex; flex-direction: column; position: relative; border: 1px solid rgba(0,0,0,0.03); margin-top: 1rem;"
                            onmouseover="this.style.transform='scale(1.05) translateY(-10px)'; this.style.boxShadow='0 25px 50px rgba(0,0,0,0.15)';"
                            onmouseout="this.style.transform='scale(1) translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.08)';">

                            <div
                                style="position: absolute; top: -1.5rem; left: 50%; transform: translateX(-50%); width: 64px; height: 64px; background: var(--color-primary); display: flex; align-items: center; justify-content: center; border-radius: 50%; color: white; box-shadow: 0 8px 16px rgba(198, 97, 63, 0.3); z-index: 2;">
                                <i class="ph ph-map-pin" aria-hidden="true" style="font-size: 1.75rem;"></i>
                            </div>

                            <div style="margin-top: 1.5rem; text-align: center;">
                                <h3
                                    style="font-family: var(--font-heading); font-size: 1.35rem; margin-bottom: 0.5rem; color: var(--color-text);">
                                    {{ $attraction['name'] }}
                                </h3>

                                <div
                                    style="display: flex; justify-content: center; gap: 0.75rem; margin-bottom: 1.5rem; font-size: 0.9rem; color: var(--color-text-secondary);">
                                    <span
                                        style="font-weight: 600; color: var(--color-primary); background: rgba(198, 97, 63, 0.1); padding: 0.25rem 0.75rem; border-radius: 20px;">{{ $attraction['time'] }}</span>
                                    <span style="padding: 0.25rem 0;">{{ $attraction['distance'] }}</span>
                                </div>

                                <p style="font-size: 0.95rem; color: var(--color-text-secondary); line-height: 1.7; margin: 0;">
                                    {{ $attraction['description'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section — Simple, editorial --}}
    <section class="section-padding reveal-on-scroll">
        <div class="container" style="text-align: center; max-width: 1000px;">
            <span class="label-caps" style="display: block; margin-bottom: 1rem; color: var(--color-primary);">Ready?</span>
            <h2 class="display-medium" style="margin-bottom: 1.5rem;">Begin your escape.</h2>
            <p style="font-size: 1.1rem; color: var(--color-text-secondary); margin-bottom: 2.5rem; line-height: 1.7;">
                Whether for a weekend retreat or an extended stay, your sanctuary awaits.
            </p>
            <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('rooms.index') }}" class="btn btn-primary">Browse Rooms</a>
                <a href="https://wa.me/6281997186379" target="_blank" class="btn btn-outline" rel="noopener">
                    <i class="ph ph-whatsapp-logo" aria-hidden="true"></i>
                    Chat With Us
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>     document.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('visible'); } }); }, { threshold: 0.1 });
                document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
            });
        </script>
    @endpush

    @push('styles')
        <style>
            /* Hero images — single column on mobile */
            @media (max-width: 640px) {
                .hero-images {
                    grid-template-columns: 1fr !important;
                    max-height: none !important;
                }

                .hero-images>div:last-child {
                    display: none;
                }
            }

            /* Hide carousel scrollbar in webkit */
            #attractions-carousel::-webkit-scrollbar {
                display: none;
            }

            /* Carousel wrapper — no overflow clip on mobile so buttons don't get cut */
            @media (max-width: 767px) {
                #attractions-carousel {
                    padding: 2rem 1rem !important;
                    gap: 1rem !important;
                }
            }
        </style>
    @endpush
@endsection