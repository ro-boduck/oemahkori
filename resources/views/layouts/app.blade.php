<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#F0EEE6">
    <meta name="description" content="OemahKori — An intimate Balinese retreat where comfort meets craftsmanship.">
    <title>@yield('title', 'Guest House') — OemahKori</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Source+Sans+3:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>
    {{-- Navigation --}}
    <header class="site-nav" role="banner">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="logo" aria-label="OemahKori Home" style="text-decoration: none;">
                <span
                    style="font-family: 'Caveat', cursive; font-size: 2.5rem; font-weight: 700; color: var(--color-primary); line-height: 1;">Oemah
                    Kori</span>
            </a>

            <nav class="nav-links" role="navigation" aria-label="Main navigation">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('rooms.index') }}"
                    class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">Rooms</a>

                @auth
                    <a href="{{ route('my-bookings') }}"
                        class="nav-link {{ request()->routeIs('my-bookings') ? 'active' : '' }}">My Bookings</a>

                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="nav-link" style="color: var(--color-primary);">Admin</a>
                    @endif

                    <span class="nav-divider" aria-hidden="true"></span>

                    <span class="text-sm font-medium"
                        style="color: var(--color-text-secondary); font-size: 0.9rem;">{{ auth()->user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-ghost" style="font-size: 0.85rem;">Logout</button>
                    </form>
                @else
                    <span class="nav-divider" aria-hidden="true"></span>
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary"
                        style="padding: 0.5rem 1.25rem; font-size: 0.85rem;">Register</a>
                @endauth
            </nav>

            {{-- Mobile Menu Button --}}
            <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Open navigation menu" aria-expanded="false"
                aria-controls="mobile-nav-drawer">
                <i class="ph ph-list" style="font-size: 1.5rem;"></i>
            </button>
        </div>
    </header>

    {{-- Mobile Nav Drawer --}}
    <div class="mobile-nav-drawer" id="mobile-nav-drawer" role="dialog" aria-modal="true"
        aria-label="Mobile navigation">
        <div class="mobile-nav-overlay" id="mobile-nav-overlay"></div>
        <nav class="mobile-nav-panel">
            <button class="mobile-nav-close" id="mobile-nav-close" aria-label="Close navigation menu">
                <i class="ph ph-x" aria-hidden="true"></i>
            </button>

            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('rooms.index') }}"
                class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">Rooms</a>

            @auth
                <a href="{{ route('my-bookings') }}"
                    class="nav-link {{ request()->routeIs('my-bookings') ? 'active' : '' }}">My Bookings</a>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="nav-link" style="color: var(--color-primary);">Admin</a>
                @endif

                <div style="padding: 1rem 0; border-top: 1px solid var(--color-border-light); margin-top: 0.5rem;">
                    <span
                        style="display: block; font-size: 0.85rem; color: var(--color-text-muted); margin-bottom: 0.75rem;">Signed
                        in as {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline"
                            style="width: 100%; font-size: 0.9rem;">Logout</button>
                    </form>
                </div>
            @else
                <div
                    style="display: flex; flex-direction: column; gap: 0.75rem; padding-top: 1rem; margin-top: 0.5rem; border-top: 1px solid var(--color-border-light);">
                    <a href="{{ route('login') }}" class="btn btn-outline" style="text-align: center;">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary" style="text-align: center;">Register</a>
                </div>
            @endauth
        </nav>
    </div>

    <main class="min-h-screen" style="padding-top: 72px;" role="main">
        {{-- Alerts --}}
        @if(session('success'))
            <div class="container" style="padding-top: 1.5rem;">
                <div
                    style="background-color: #D1FAE5; border: 1px solid #A7F3D0; color: #065F46; padding: 1rem 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-size: 0.95rem;">
                    <i class="ph-fill ph-check-circle" style="font-size: 1.25rem;" aria-hidden="true"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="container" style="padding-top: 1.5rem;">
                <div
                    style="background-color: #FEE2E2; border: 1px solid #FECACA; color: #991B1B; padding: 1rem 1.5rem; font-size: 0.95rem;">
                    <ul style="list-style: disc; padding-left: 1.25rem; margin: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer role="contentinfo"
        style="margin-top: 8rem; border-top: 1px solid var(--color-border); background-color: var(--color-surface);">
        <div class="container" style="padding-top: 5rem; padding-bottom: 3rem;">
            <div style="display: grid; grid-template-columns: 1fr; gap: 3rem;">
                {{-- Top row: Brand + Nav columns --}}
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 3rem;">
                    {{-- Brand --}}
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.25rem;">
                            <span
                                style="font-family: var(--font-script); font-size: 2rem; font-weight: 700; color: var(--color-text);">Oemah
                                Kori</span>
                        </div>
                        <p
                            style="font-size: 0.9rem; color: var(--color-text-secondary); line-height: 1.7; max-width: 280px;">
                            An intimate sanctuary in Bali where handcrafted comfort meets the art of slow living.
                        </p>
                    </div>

                    {{-- Explore --}}
                    <div>
                        <span class="label-caps"
                            style="display: block; margin-bottom: 1.5rem; color: var(--color-primary);">Explore</span>
                        <ul
                            style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem;">
                            <li><a href="{{ route('home') }}"
                                    style="font-size: 1rem; color: var(--color-text-secondary); transition: color 0.2s;"
                                    onmouseover="this.style.color='var(--color-primary)'"
                                    onmouseout="this.style.color='var(--color-text-secondary)'">Home</a></li>
                            <li><a href="{{ route('rooms.index') }}"
                                    style="font-size: 1rem; color: var(--color-text-secondary); transition: color 0.2s;"
                                    onmouseover="this.style.color='var(--color-primary)'"
                                    onmouseout="this.style.color='var(--color-text-secondary)'">Our Rooms</a></li>
                            <li><a href="#"
                                    style="font-size: 1rem; color: var(--color-text-secondary); transition: color 0.2s;"
                                    onmouseover="this.style.color='var(--color-primary)'"
                                    onmouseout="this.style.color='var(--color-text-secondary)'">Experiences</a></li>
                        </ul>
                    </div>

                    {{-- Contact --}}
                    <div>
                        <span class="label-caps"
                            style="display: block; margin-bottom: 1.5rem; color: var(--color-primary);">Contact</span>
                        <ul
                            style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem;">
                            <li
                                style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; color: var(--color-text-secondary);">
                                <i class="ph ph-instagram-logo" aria-hidden="true"></i> @Oemahkori
                            </li>
                            <li
                                style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; color: var(--color-text-secondary);">
                                <i class="ph ph-phone" aria-hidden="true"></i> 081997186379
                            </li>
                            <li
                                style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; color: var(--color-text-secondary);">
                                <i class="ph ph-map-pin" aria-hidden="true"></i> Bali, Indonesia
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="footer-bottom"
                style="margin-top: 4rem; padding-top: 2rem; border-top: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <span style="font-size: 0.8rem; color: var(--color-text-muted);">&copy; {{ date('Y') }} OemahKori. All
                    rights reserved.</span>
                <span style="font-size: 0.8rem; color: var(--color-text-muted);">Crafted with intention.</span>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <script>
        // ─── Mobile Nav Drawer ──────────────────────────────────────────────
        (function () {
            const btn = document.getElementById('mobile-menu-btn');
            const drawer = document.getElementById('mobile-nav-drawer');
            const overlay = document.getElementById('mobile-nav-overlay');
            const closeBtn = document.getElementById('mobile-nav-close');

            function openDrawer() {
                drawer.classList.add('open');
                btn.setAttribute('aria-expanded', 'true');
                document.body.style.overflow = 'hidden';
            }

            function closeDrawer() {
                drawer.classList.remove('open');
                btn.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }

            if (btn) btn.addEventListener('click', openDrawer);
            if (overlay) overlay.addEventListener('click', closeDrawer);
            if (closeBtn) closeBtn.addEventListener('click', closeDrawer);

            // Close on Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && drawer.classList.contains('open')) {
                    closeDrawer();
                }
            });
        })();
    </script>
</body>

</html>