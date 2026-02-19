<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#9B3B22">
    <title>@yield('title', 'Dashboard') — OemahKori Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Source+Sans+3:wght@300;400;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="admin-body">


    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay"
        style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:39; backdrop-filter:blur(2px);"
        aria-hidden="true"></div>

    <aside class="admin-sidebar" id="admin-sidebar" aria-label="Admin navigation">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="logo" style="text-decoration: none; color: white;">
                <i class="ph-fill ph-house-line logo-icon" aria-hidden="true" style="color: var(--color-primary);"></i>
                <span class="logo-text"
                    style="font-family: 'Caveat', cursive; font-size: 1.8rem; letter-spacing: 0.5px;">OemahKori</span>
            </a>
        </div>
        <nav aria-label="Admin menu">
            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="ph ph-squares-four" aria-hidden="true"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.rooms') }}"
                        class="{{ request()->routeIs('admin.rooms*') ? 'active' : '' }}">
                        <i class="ph ph-bed" aria-hidden="true"></i> Rooms
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bookings') }}"
                        class="{{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">
                        <i class="ph ph-clipboard-text" aria-hidden="true"></i> Bookings
                    </a>
                </li>
                <li class="sidebar-divider"></li>
                <li>
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="ph ph-globe" aria-hidden="true"></i> View Site
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-link-btn">
                            <i class="ph ph-sign-out" aria-hidden="true"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="admin-main">
        <header class="admin-header">
            <button class="sidebar-toggle" id="sidebar-toggle" aria-label="Toggle sidebar" aria-expanded="true"
                aria-controls="admin-sidebar">
                <i class="ph ph-list" aria-hidden="true"></i>
            </button>
            <h1 class="admin-page-title">@yield('title', 'Dashboard')</h1>
            <div class="admin-user">
                <div
                    style="background: var(--color-primary-muted); width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--color-primary); font-weight: 700;">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <span>{{ auth()->user()->name }}</span>
            </div>
        </header>

        <main id="main-content" class="admin-content">
            @if(session('success'))
                <div class="alert alert-success" role="alert" aria-live="polite">
                    <span aria-hidden="true">✓</span> {{ session('success') }}
                    <button type="button" class="alert-close" aria-label="Dismiss alert"
                        onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error" role="alert" aria-live="polite">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="alert-close" aria-label="Dismiss alert"
                        onclick="this.parentElement.remove()">×</button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isMobile = () => window.innerWidth < 768;

            function openSidebar() {
                if (isMobile()) {
                    sidebar.classList.add('mobile-open');
                    overlay.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                } else {
                    sidebar.classList.toggle('toggled');
                }
            }

            function closeSidebar() {
                sidebar.classList.remove('mobile-open');
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }

            if (sidebarToggle) sidebarToggle.addEventListener('click', openSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);

            // Close on resize to desktop
            window.addEventListener('resize', function () {
                if (!isMobile()) closeSidebar();
            });
        });
    </script>
    @stack('scripts')
</body>

</html>