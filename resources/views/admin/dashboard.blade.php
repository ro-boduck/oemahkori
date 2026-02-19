@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="color: var(--color-primary);">
                <i class="ph ph-bed" aria-hidden="true"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value" style="font-variant-numeric: tabular-nums">{{ $stats['totalRooms'] }}</span>
                <span class="stat-label">Total Rooms</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="color: #059669;">
                <i class="ph ph-check-circle" aria-hidden="true"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value" style="font-variant-numeric: tabular-nums">{{ $stats['availableRooms'] }}</span>
                <span class="stat-label">Available</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="color: #D97706;">
                <i class="ph ph-clock" aria-hidden="true"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value" style="font-variant-numeric: tabular-nums">{{ $stats['pendingBookings'] }}</span>
                <span class="stat-label">Pending</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="color: #7C3AED;">
                <i class="ph ph-currency-circle-dollar" aria-hidden="true"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value" style="font-variant-numeric: tabular-nums">Rp
                    {{ number_format($stats['totalRevenue'], 0, ',', '.') }}</span>
                <span class="stat-label">Total Revenue</span>
            </div>
        </div>
    </div>

    <div class="dashboard-sections">
        <section class="dashboard-card">
            <div class="top-actions">
                <h2>Recent Bookings</h2>
                <a href="{{ route('admin.bookings') }}" class="sidebar-link-btn"
                    style="width: auto; padding: 0.4rem 0.8rem; border: 1px solid var(--color-border); justify-content: center;">
                    View All <i class="ph ph-arrow-right"></i>
                </a>
            </div>
            @if($recentBookings->isEmpty())
                <p class="text-muted" style="text-align: center; padding: 2rem;">No bookings yet.</p>
            @else
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th scope="col">Guest</th>
                                <th scope="col">Room</th>
                                <th scope="col">Dates</th>
                                <th scope="col">Status</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBookings as $booking)
                                <tr>
                                    <td>
                                        <div style="font-weight: 500;">{{ $booking->user->name }}</div>
                                        <div style="font-size: 0.8rem; color: var(--color-text-muted);">
                                            {{ $booking->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td>{{ $booking->room->name }}</td>
                                    <td style="font-variant-numeric: tabular-nums">
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <i class="ph ph-calendar-blank" style="color: var(--color-text-muted);"></i>
                                            <span>
                                                {{ $booking->check_in->format('M d') }} – {{ $booking->check_out->format('M d') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ $booking->status }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td style="font-variant-numeric: tabular-nums; font-weight: 600;">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <section class="dashboard-card">
            <div class="top-actions">
                <h2>Quick Stats</h2>
            </div>
            <ul class="quick-stats" style="list-style: none; padding: 0;">
                <li
                    style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; border-bottom: 1px solid var(--color-border);">
                    <span class="qs-label" style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="ph ph-users" style="font-size: 1.2rem; color: var(--color-primary);"></i> Total Bookings
                    </span>
                    <span class="qs-value"
                        style="font-variant-numeric: tabular-nums; font-weight: 600;">{{ $stats['totalBookings'] }}</span>
                </li>
                <li
                    style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; border-bottom: 1px solid var(--color-border);">
                    <span class="qs-label" style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="ph ph-check-square" style="font-size: 1.2rem; color: #059669;"></i> Confirmed
                    </span>
                    <span class="qs-value"
                        style="font-variant-numeric: tabular-nums; font-weight: 600;">{{ $stats['confirmedBookings'] }}</span>
                </li>
                <li style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0;">
                    <span class="qs-label" style="display: flex; align-items: center; gap: 0.5rem;">
                        <i class="ph ph-user-plus" style="font-size: 1.2rem; color: #7C3AED;"></i> Registered Guests
                    </span>
                    <span class="qs-value"
                        style="font-variant-numeric: tabular-nums; font-weight: 600;">{{ $stats['totalGuests'] }}</span>
                </li>
            </ul>
        </section>
    </div>
@endsection