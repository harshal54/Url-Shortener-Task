@extends('layouts.app')

@section('title', 'Invite User')

@section('content')
<h2>
    @if($user->isSuperAdmin())
        Invite New Client (Admin)
    @else
        Invite Team Member
    @endif
</h2>
<p style="color: #666; margin-bottom: 30px;">
    @if($user->isSuperAdmin())
        Send an invitation to create a new company with an Admin user.
    @else
        Invite a new member to join your company team.
    @endif
</p>

<form action="{{ route('invitations.store') }}" method="POST" style="max-width: 600px;">
    @csrf

    @if($user->isSuperAdmin())
        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input
                type="text"
                id="company_name"
                name="company_name"
                value="{{ old('company_name') }}"
                placeholder="Acme Corporation"
                required
            >
        </div>
    @endif

    <div class="form-group">
        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="user@example.com"
            required
        >
        <small style="color: #666; display: block; margin-top: 5px;">
          Note : I don't have the SMTP Details, So I will give an url to invite the User (Admin Or Member) Just by Click on the generated URL.
        </small>
    </div>

    <div style="display: flex; gap: 10px;">
        <button type="submit" class="btn">Send Invitation</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
