@extends('layouts.admin')
@section('title', 'Manage Rooms')

@section('content')
    <div class="top-actions" style="margin-bottom: 2rem;">
        <h2 style="font-family: var(--font-heading); font-size: 1.5rem;">Manage Rooms</h2>
        <a href="{{ route('admin.rooms.create') }}" class="sidebar-link-btn" style="width: auto; padding: 0.6rem 1.2rem; background: var(--color-primary); color: white; justify-content: center;">
            <i class="ph ph-plus" style="font-weight: bold;"></i> Add Room
        </a>
    </div>

    <div class="dashboard-card">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th scope="col">Room</th>
                        <th scope="col">Type</th>
                        <th scope="col">Price/Night</th>
                        <th scope="col">Capacity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Bookings</th>
                        <th scope="col" style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td>
                                <div class="table-room-name" style="display: flex; align-items: center; gap: 1rem;">
                                    @if($room->image)
                                        <div style="width: 48px; height: 36px; border-radius: 6px; overflow: hidden; flex-shrink: 0;">
                                            <img src="{{ asset('storage/' . $room->image) }}" alt="" 
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    @else
                                        <div style="width: 48px; height: 36px; border-radius: 6px; background: var(--color-surface-hover); display: flex; align-items: center; justify-content: center; color: var(--color-text-muted);">
                                            <i class="ph ph-image"></i>
                                        </div>
                                    @endif
                                    <div style="font-weight: 600;">{{ $room->name }}</div>
                                </div>
                            </td>
                            <td><span class="room-badge room-badge-sm">{{ ucfirst($room->type) }}</span></td>
                            <td style="font-variant-numeric: tabular-nums">Rp
                                {{ number_format($room->price_per_night, 0, ',', '.') }}</td>
                            <td>{{ $room->capacity }}</td>
                            <td>
                                <span class="status-badge status-{{ $room->status }}">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </td>
                            <td style="font-variant-numeric: tabular-nums; text-align: center;">{{ $room->bookings_count }}</td>
                            <td>
                                <div class="action-buttons" style="justify-content: flex-end; display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-outline"
                                        aria-label="Edit {{ $room->name }}" style="padding: 0.4rem; border-radius: 6px;">
                                        <i class="ph ph-pencil-simple" style="font-size: 1.1rem;"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.rooms.delete', $room) }}"
                                        onsubmit="return confirm('Delete this room? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            aria-label="Delete {{ $room->name }}" style="padding: 0.4rem; border-radius: 6px; display: flex; align-items: center;">
                                            <i class="ph ph-trash" style="font-size: 1.1rem;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection