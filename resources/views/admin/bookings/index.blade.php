@extends('layouts.admin')
@section('title', 'Manage Bookings')

@section('content')
    <div class="top-actions" style="margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <h2 style="font-family: var(--font-heading); font-size: 1.5rem;">Manage Bookings</h2>

        <div class="filter-pills"
            style="display: flex; gap: 0.5rem; background: white; padding: 0.25rem; border-radius: 8px; border: 1px solid var(--color-border);">
            <a href="{{ route('admin.bookings') }}" class="sidebar-link-btn {{ !request('status') ? 'active' : '' }}"
                style="width: auto; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; {{ !request('status') ? 'background: var(--color-primary-muted); color: var(--color-primary); font-weight: 600;' : 'color: var(--color-text-secondary);' }}">
                All
            </a>
            <a href="{{ route('admin.bookings', ['status' => 'pending']) }}"
                class="sidebar-link-btn {{ request('status') == 'pending' ? 'active' : '' }}"
                style="width: auto; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; {{ request('status') == 'pending' ? 'background: var(--color-primary-muted); color: var(--color-primary); font-weight: 600;' : 'color: var(--color-text-secondary);' }}">
                Pending
            </a>
            <a href="{{ route('admin.bookings', ['status' => 'confirmed']) }}"
                class="sidebar-link-btn {{ request('status') == 'confirmed' ? 'active' : '' }}"
                style="width: auto; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; {{ request('status') == 'confirmed' ? 'background: var(--color-primary-muted); color: var(--color-primary); font-weight: 600;' : 'color: var(--color-text-secondary);' }}">
                Confirmed
            </a>
            <a href="{{ route('admin.bookings', ['status' => 'completed']) }}"
                class="sidebar-link-btn {{ request('status') == 'completed' ? 'active' : '' }}"
                style="width: auto; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; {{ request('status') == 'completed' ? 'background: var(--color-primary-muted); color: var(--color-primary); font-weight: 600;' : 'color: var(--color-text-secondary);' }}">
                Completed
            </a>
            <a href="{{ route('admin.bookings', ['status' => 'cancelled']) }}"
                class="sidebar-link-btn {{ request('status') == 'cancelled' ? 'active' : '' }}"
                style="width: auto; padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; {{ request('status') == 'cancelled' ? 'background: var(--color-primary-muted); color: var(--color-primary); font-weight: 600;' : 'color: var(--color-text-secondary);' }}">
                Cancelled
            </a>
        </div>
    </div>

    <div class="dashboard-card">
        @if($bookings->isEmpty())
            <div class="empty-state" style="text-align: center; padding: 4rem 2rem;">
                <div style="font-size: 3rem; margin-bottom: 1rem; color: var(--color-text-muted); opacity: 0.5;">
                    <i class="ph ph-clipboard-text"></i>
                </div>
                <h3 style="font-size: 1.2rem; color: var(--color-text);">No Bookings Found</h3>
                <p style="color: var(--color-text-muted);">There are no bookings matching your criteria.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Guest & Room</th>
                            <th scope="col">Dates</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col" style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td style="font-variant-numeric: tabular-nums; color: var(--color-text-muted);">#{{ $booking->id }}
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: var(--color-text);">{{ $booking->user->name }}</div>
                                    <div style="font-size: 0.85rem; color: var(--color-primary); margin-top: 0.2rem;">
                                        {{ $booking->room->name }}</div>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem;">
                                        <i class="ph ph-calendar-blank" style="color: var(--color-text-muted);"></i>
                                        <span>
                                            {{ $booking->check_in->format('M d') }} – {{ $booking->check_out->format('M d, Y') }}
                                        </span>
                                    </div>
                                    <div style="font-size: 0.8rem; color: var(--color-text-muted); margin-left: 1.4rem;">
                                        {{ $booking->check_in->diffInDays($booking->check_out) }} nights • {{ $booking->guests }}
                                        guests
                                    </div>
                                </td>
                                <td style="font-variant-numeric: tabular-nums; font-weight: 600;">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $booking->status }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons" style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                                        @if($booking->status === 'pending')
                                            <form method="POST" action="{{ route('admin.bookings.status', $booking) }}">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    style="padding: 0.4rem 0.8rem; display: flex; align-items: center; gap: 0.4rem;"
                                                    aria-label="Confirm booking">
                                                    <i class="ph ph-check-circle" style="font-weight: bold;"></i> Confirm
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.bookings.status', $booking) }}">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    style="padding: 0.4rem 0.8rem; display: flex; align-items: center; gap: 0.4rem;"
                                                    aria-label="Cancel booking">
                                                    <i class="ph ph-x-circle" style="font-weight: bold;"></i> Cancel
                                                </button>
                                            </form>
                                        @elseif($booking->status === 'confirmed')
                                            <form method="POST" action="{{ route('admin.bookings.status', $booking) }}">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    style="padding: 0.4rem 0.8rem; display: flex; align-items: center; gap: 0.4rem;"
                                                    aria-label="Complete booking">
                                                    <i class="ph ph-check-circle" style="font-weight: bold;"></i> Complete
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.bookings.status', $booking) }}">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled">
                                                <button type="submit" class="btn btn-sm btn-outline"
                                                    style="padding: 0.4rem 0.8rem; display: flex; align-items: center; gap: 0.4rem; border: 1px solid var(--color-border);"
                                                    aria-label="Cancel booking">
                                                    <i class="ph ph-x" style="font-weight: bold;"></i> Cancel
                                                </button>
                                            </form>
                                        @else
                                            <span style="color: var(--color-text-muted); font-size: 0.85rem;">—</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection