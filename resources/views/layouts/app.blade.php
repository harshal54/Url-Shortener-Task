<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'URL Shortener')</title>
    <style>
*{margin:0;padding:0;box-sizing:border-box}

body{
    font-family:Arial,sans-serif;
    line-height:1.6;
    padding:20px;
    background:#f4f4f4;
}

.container{
    max-width:1200px;
    margin:auto;
    background:#fff;
    padding:20px;
    border-radius:5px;
    box-shadow:0 2px 5px rgba(0,0,0,.1);
}

/* Header */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding-bottom:20px;
    margin-bottom:20px;
    border-bottom:2px solid #333;
}
.header h1{color:#333}

/* Navigation */
.nav{
    display:flex;
    gap:15px;
    align-items:center;
}
.nav a,
.nav button{
    padding:8px 15px;
    color:#333;
    text-decoration:none;
    border:1px solid #ddd;
    border-radius:3px;
    background:#fff;
    cursor:pointer;
}
.nav a:hover,
.nav button:hover{background:#f0f0f0}

.logout-btn{
    background:#dc3545;
    color:#fff;
    border:none;
}
.logout-btn:hover{background:#c82333}

/* Alerts */
.alert{
    padding:12px;
    margin-bottom:20px;
    border-radius:4px;
}
.alert-success{
    background:#d4edda;
    color:#155724;
    border:1px solid #c3e6cb;
}
.alert-error{
    background:#f8d7da;
    color:#721c24;
    border:1px solid #f5c6cb;
}

/* Buttons */
.btn{
    display:inline-block;
    padding:10px 20px;
    color:#fff;
    border:none;
    border-radius:4px;
    cursor:pointer;
    text-decoration:none;
    background:#007bff;
}
.btn:hover{background:#0056b3}
.btn-secondary{background:#6c757d}
.btn-secondary:hover{background:#545b62}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}
th,td{
    padding:12px;
    text-align:left;
    border-bottom:1px solid #ddd;
}
th{
    background:#f8f9fa;
    font-weight:bold;
}
tr:hover{background:#f8f9fa}

/* Forms */
.form-group{margin-bottom:15px}
.form-group label{
    display:block;
    margin-bottom:5px;
    font-weight:bold;
}
.form-group input,
.form-group textarea{
    width:100%;
    padding:10px;
    border:1px solid #ddd;
    border-radius:4px;
}
.form-group input:focus,
.form-group textarea:focus{
    outline:none;
    border-color:#007bff;
}

/* Role Badges */
.role-badge{
    display:inline-block;
    padding:3px 8px;
    border-radius:3px;
    font-size:12px;
    font-weight:bold;
}
.role-superadmin{background:#ffc107;color:#000}
.role-admin{background:#28a745;color:#fff}
.role-member{background:#17a2b8;color:#fff}
</style>

</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>URL Shortener</h1>
                @auth
                    <p style="color: #666; margin-top: 5px;">
                        {{ auth()->user()->name }}
                        <span class="role-badge role-{{ auth()->user()->role }}">
                            {{ strtoupper(auth()->user()->role) }}
                        </span>
                        @if(auth()->user()->company)
                            | {{ auth()->user()->company->name }}
                        @endif
                    </p>
                @endauth
            </div>
            @auth
                <div class="nav">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    {{-- @if(!auth()->user()->isSuperAdmin())
                        <a href="{{ route('short-urls.index') }}">Short URLs</a>
                        <a href="{{ route('short-urls.create') }}">Generate URL</a>
                    @endif --}}
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
                        <a href="{{ route('invitations.create') }}">Invite User</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            @endauth
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
