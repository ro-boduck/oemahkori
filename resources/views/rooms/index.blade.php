@extends('layouts.app')

@section('title', 'Our Rooms')

@section('content')
    {{-- Page Header — Clean, editorial --}}
    <section style="padding: 4rem 0 3rem; position: relative;">
        <div class="container" style="text-align: center;">
            <div class="reveal-on-scroll">
                <div style="display: flex; align-items: center; justify-content: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <span style="display: block; width: 32px; height: 1.5px; background-color: var(--color-primary);"></span>
                    <span class="label-caps" style="color: var(--color-primary);">Stay With Us</span>
                    <span style="display: block; width: 32px; height: 1.5px; background-color: var(--color-primary);"></span>
                </div>
                <h1 class="display-large" style="margin-bottom: 1rem;">Your Sanctuary Awaits</h1>
                <p style="color: var(--color-text-secondary); max-width: 500px; margin: 0 auto; font-size: 1.05rem; line-height: 1.7;">
                    Find your perfect space. Designed for comfort, styled for peace.
                </p>
            </div>
        </div>
    </section>

    <div class="container" style="padding-bottom: 6rem;">
        {{-- Filter Tabs — Minimal, editorial --}}
        <div class="reveal-on-scroll" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 0.5rem; margin-bottom: 4rem; padding-bottom: 2rem; border-bottom: 1px solid var(--color-border);">
            <a href="{{ route('rooms.index') }}"
               style="padding: 0.625rem 1.5rem; font-size: 0.85rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; transition: all 0.3s ease; text-decoration: none;
               {{ !request('type') ? 'background-color: var(--color-accent); color: var(--color-surface); border-radius: 8px 0 0 8px;' : 'background: transparent; color: var(--color-text-secondary); border: 1px solid var(--color-border);' }}">
                All
            </a>

            @foreach($roomTypes as $type)
                <a href="{{ route('rooms.index', ['type' => $type->type]) }}"
                   style="padding: 0.625rem 1.5rem; font-size: 0.85rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; transition: all 0.3s ease; text-decoration: none;
                   {{ request('type') == $type->type ? 'background-color: var(--color-accent); color: var(--color-surface); border-radius: 8px 0 0 8px;' : 'background: transparent; color: var(--color-text-secondary); border: 1px solid var(--color-border);' }}">
                    {{ ucfirst($type->type) }}
                </a>
            @endforeach
        </div>

        {{-- Rooms Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 2.5rem;">
            @foreach($rooms as $index => $room)
                <article class="reveal-on-scroll" style="transition: all 0.4s ease;">
                    {{-- Image --}}
                    <div style="aspect-ratio: 4/3; overflow: hidden; position: relative; margin-bottom: 1.5rem;">
                        @if($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}"
                                 style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);"
                                 loading="lazy" width="400" height="300"
                                 onmouseover="this.style.transform='scale(1.05)'"
                                 onmouseout="this.style.transform='scale(1)'">
                        @else
                            <div style="width: 100%; height: 100%; background: var(--color-bg-alt); display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; color: var(--color-text-muted);">
                                <i class="ph ph-image" style="font-size: 2.5rem; opacity: 0.3;" aria-hidden="true"></i>
                                <span style="font-size: 0.85rem; opacity: 0.5;">No Image</span>
                            </div>
                        @endif

                        <span class="room-badge" style="position: absolute; top: 1rem; left: 1rem; background: rgba(250, 249, 245, 0.95); backdrop-filter: blur(8px);">
                            {{ $room->type }}
                        </span>
                    </div>

                    {{-- Content --}}
                    <div style="padding: 1rem 1.5rem 2.5rem 1.5rem; border-bottom: 1px solid var(--color-border-light);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                            <h2 style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 600;">
                                <a href="{{ route('rooms.show', $room) }}" style="text-decoration: none; color: var(--color-text); transition: color 0.2s;"
                                   onmouseover="this.style.color='var(--color-primary)'"
                                   onmouseout="this.style.color='var(--color-text)'">
                                    {{ $room->name }}
                                </a>
                            </h2>
                            <div style="text-align: right; flex-shrink: 0; padding-left: 1rem;">
                                <span style="font-size: 0.75rem; color: var(--color-text-muted);">IDR</span>
                                <span style="font-size: 1.1rem; font-weight: 700; color: var(--color-text); font-variant-numeric: tabular-nums;">{{ number_format($room->price_per_night, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <p style="font-size: 0.9rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $room->description }}
                        </p>

                        <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 1rem; border-top: 1px solid var(--color-border-light);">
                            <div style="display: flex; gap: 1.25rem; font-size: 0.85rem; color: var(--color-text-muted);">
                                <span style="display: flex; align-items: center; gap: 0.375rem;">
                                    <i class="ph ph-users" aria-hidden="true"></i> {{ $room->capacity }}
                                </span>
                                <span style="display: flex; align-items: center; gap: 0.375rem;">
                                    <i class="ph ph-bed" aria-hidden="true"></i>
                                    {{ $room->type == 'deluxe' || $room->type == 'suite' ? 'King' : 'Queen' }}
                                </span>
                            </div>

                            <a href="{{ route('rooms.show', $room) }}" class="btn btn-primary" style="padding: 0.5rem 1.25rem; font-size: 0.8rem;">
                                View Details
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                        }
                    });
                }, { threshold: 0.1 });

                document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
            });
        </script>
    @endpush
@endsection