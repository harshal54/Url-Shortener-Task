@extends('layouts.app')

@section('title', 'SuperAdmin Dashboard')

@section('content')
<h2>SuperAdmin Dashboard</h2>
<p style="color: #666; margin-bottom: 30px;">Manage companies and view all short URLs across the platform.</p>

<div style="margin-bottom: 40px;">
    <h3 style="margin-bottom: 15px;">Companies</h3>
    <table>
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Total Users</th>
                <th>Total Short URLs</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr>
                    <td><strong>{{ $company->name }}</strong></td>
                    <td>{{ $company->users_count }}</td>
                    <td>{{ $company->short_urls_count }}</td>
                    <td>{{ $company->created_at->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #999;">No companies yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div>
    <h3 style="margin-bottom: 15px;">All Short URLs</h3>
    <table>
        <thead>
            <tr>
                <th>Short Code</th>
                <th>Original URL</th>
                <th>Company</th>
                <th>Created By</th>
                <th>Clicks</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shortUrls as $url)
                <tr>
                    <td>
                        <a href="{{ $url->full_url }}" target="_blank" style="color: #007bff; text-decoration: none;">
                            {{ $url->short_code }}
                        </a>
                    </td>
                    <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <a href="{{ $url->original_url }}" target="_blank" style="color: #666; text-decoration: none;">
                            {{ $url->original_url }}
                        </a>
                    </td>
                    <td>{{ $url->company->name }}</td>
                    <td>{{ $url->user->name }}</td>
                    <td>{{ $url->click_count }}</td>
                    <td>{{ $url->created_at->format('M d, Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #999;">No short URLs yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
