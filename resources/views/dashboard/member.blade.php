@extends('layouts.app')

@section('title', 'Member Dashboard')

@section('content')
<h2>Member Dashboard</h2>
<p style="color: #666; margin-bottom: 30px;">View and manage your short URLs.</p>

<div>
    <h3 style="margin-bottom: 15px;">My Short URLs</h3>
    <table>
        <thead>
            <tr>
                <th>Short Code</th>
                <th>Original URL</th>
                <th>Clicks</th>
                <th>Created At</th>
                <th>Actions</th>
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
                    <td><strong>{{ $url->click_count }}</strong></td>
                    <td>{{ $url->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <button onclick="copyToClipboard('{{ $url->full_url }}')" class="btn" style="padding: 5px 10px; font-size: 12px;">
                            Copy Link
                        </button>
                    </td>
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

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('Short URL copied to clipboard!');
    }, function(err) {
        alert('Failed to copy URL');
    });
}
</script>
@endsection
