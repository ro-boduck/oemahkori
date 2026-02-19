@extends('layouts.app')
@section('title', 'Login')

@section('content')
    <div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 2rem;">
        <div style="width: 100%; max-width: 440px;">
            {{-- Card --}}
            <div class="auth-card"
                style="background: var(--color-surface); border: 1px solid var(--color-border-light); padding: 3rem; position: relative;">
                {{-- Accent line --}}
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 2px; background: var(--color-primary);"
                    aria-hidden="true"></div>

                <div style="text-align: center; margin-bottom: 2.5rem;">
                    <div
                        style="width: 48px; height: 48px; background: var(--color-primary-muted); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; border-radius: 8px 0 0 8px;">
                        <i class="ph ph-lock-key-open" style="font-size: 1.5rem; color: var(--color-primary);"
                            aria-hidden="true"></i>
                    </div>
                    <h1 class="display-small" style="margin-bottom: 0.5rem;">Welcome Back</h1>
                    <p style="color: var(--color-text-secondary); font-size: 0.9rem;">Sign in to manage your bookings.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="you@email.com…"
                            autocomplete="email" spellcheck="false">
                        @error('email')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" required
                            class="form-control @error('password') is-invalid @enderror" autocomplete="current-password">
                        @error('password')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; font-size: 0.85rem;">
                        <label
                            style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: var(--color-text-secondary);">
                            <input type="checkbox" name="remember" id="remember"
                                style="accent-color: var(--color-primary); width: 16px; height: 16px;" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>
                        <a href="#"
                            style="color: var(--color-primary); text-decoration: none; font-weight: 500; transition: opacity 0.2s;"
                            onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.875rem;">
                        Sign In
                    </button>
                </form>

                <div style="margin-top: 2rem; text-align: center; font-size: 0.9rem; color: var(--color-text-secondary);">
                    <p>Don't have an account?
                        <a href="{{ route('register') }}"
                            style="color: var(--color-text); font-weight: 600; text-decoration: underline; text-underline-offset: 3px; transition: color 0.2s;"
                            onmouseover="this.style.color='var(--color-primary)'"
                            onmouseout="this.style.color='var(--color-text)'">Create one here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection