@extends('layouts.app')
@section('title', 'Register')

@section('content')
    <div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 2rem;">
        <div style="width: 100%; max-width: 440px;">
            {{-- Card --}}
            <div class="auth-card"
                style="background: var(--color-surface); border: 1px solid var(--color-border-light); padding: 3rem; position: relative;">
                {{-- Accent line --}}
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent));"
                    aria-hidden="true"></div>

                <div style="text-align: center; margin-bottom: 2.5rem;">
                    <div
                        style="width: 48px; height: 48px; background: var(--color-primary-muted); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; border-radius: 0 8px 8px 0;">
                        <i class="ph ph-sparkle" style="font-size: 1.5rem; color: var(--color-primary);"
                            aria-hidden="true"></i>
                    </div>
                    <h1 class="display-small" style="margin-bottom: 0.5rem;">Join OemahKori</h1>
                    <p style="color: var(--color-text-secondary); font-size: 0.9rem;">Begin your journey to serenity.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Your Name…"
                            autocomplete="name">
                        @error('name')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

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
                            class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                        <span class="form-hint" style="text-align: right;">Min. 8 characters</span>
                        @error('password')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="form-control" autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; padding: 0.875rem; margin-top: 0.5rem;">
                        Create Account
                    </button>
                </form>

                <div style="margin-top: 2rem; text-align: center; font-size: 0.9rem; color: var(--color-text-secondary);">
                    <p>Already a member?
                        <a href="{{ route('login') }}"
                            style="color: var(--color-text); font-weight: 600; text-decoration: underline; text-underline-offset: 3px; transition: color 0.2s;"
                            onmouseover="this.style.color='var(--color-primary)'"
                            onmouseout="this.style.color='var(--color-text)'">Sign in here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection