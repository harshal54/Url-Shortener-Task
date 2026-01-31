@extends('layouts.app')

@section('title', 'Accept Invitation')

@section('content')
<div style="max-width: 500px; margin: 0 auto;">
    <h2 style="margin-bottom: 20px;">Accept Invitation</h2>

    <div style="background: #e7f3ff; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
        <p style="margin: 0;"><strong>You've been invited to join:</strong></p>
        @if($invitation->company_name)
            <p style="margin: 5px 0 0 0; font-size: 18px; color: #007bff;">
                {{ $invitation->company_name }} (New Company)
            </p>
            <p style="margin: 5px 0 0 0; color: #666;">Role: <strong>Admin</strong></p>
        @else
            <p style="margin: 5px 0 0 0; font-size: 18px; color: #007bff;">
                {{ $invitation->company->name }}
            </p>
            <p style="margin: 5px 0 0 0; color: #666;">Role: <strong>Member</strong></p>
        @endif
    </div>

    <form action="{{ route('invitations.accept', $invitation->token) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
            >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                value="{{ $invitation->email }}"
                disabled
                style="background: #f0f0f0;"
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >
            <small style="color: #666; display: block; margin-top: 5px;">
                Minimum 8 characters
            </small>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
            >
        </div>

        <button type="submit" class="btn" style="width: 100%;">Complete Registration</button>
    </form>
</div>
@endsection
