@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div style="max-width: 400px; margin: 50px auto;">
    <h2 style="margin-bottom: 20px;">Login</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn" style="width: 100%;">Login</button>
    </form>

    <p style="margin-top: 20px;">
         SuperAdmin credentials:<br>
        <strong>Email:</strong> superadmin@example.com<br>
        <strong>Password:</strong> password
    </p>
</div>
@endsection
