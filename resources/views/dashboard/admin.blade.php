@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h2>Admin Dashboard - {{ auth()->user()->company->name }}</h2>
<p style="color: #666; margin-bottom: 30px;">Manage your company's short URLs and team members.</p>

<div style="margin-bottom: 40px;">
    <h3 style="margin-bottom: 15px;">Team Members</h3>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teamMembers as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                        <span class="role-badge role-{{ $member->role }}">
                            {{ strtoupper($member->role) }}
                        </span>
                    </td>
                    <td>{{ $member->created_at->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #999;">No team members yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div>
    <h3 style="margin-bottom: 15px;">Company Short URLs</h3>
    <table>
        <thead>
            <tr>
                <th>Short Code</th>
                <th>Original URL</th>
                <th>Created By</th>
                <th>Clicks</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shortUrls as $url)
                <tr>
                    <td>
                        <a href="{{ $url->full_url }}" target="_blank" style="color: #007bff; text-decoration: none; font-weight: bold;">
                            {{ $url->short_code }}
                        </a>
                    </td>
                    <td style="max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <a href="{{ $url->original_url }}" target="_blank" style="color: #666; text-decoration: none;">
                            {{ $url->original_url }}
                        </a>
                    </td>
                    <td>{{ $url->user->name }}</td>
                    <td><strong>{{ $url->click_count }}</strong></td>
                    <td>{{ $url->created_at->format('M d, Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #999;">
                        No short URLs yet. <a href="{{ route('short-urls.create') }}" style="color: #007bff;">Create!</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
