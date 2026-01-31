@extends('layouts.app')

@section('title', 'Generate Short URL')

@section('content')
<h2>Generate Short URL</h2>
<p style="color: #666; margin-bottom: 30px;">Create a shortened URL for easy sharing.</p>

<form action="{{ route('short-urls.store') }}" method="POST" style="max-width: 600px;">
    @csrf

    <div class="form-group">
        <label for="original_url">Original URL</label>
        <input
            type="url"
            id="original_url"
            name="original_url"
            value="{{ old('original_url') }}"
            placeholder="https://example.com/demo"
            required
            autofocus
        >
        <small style="color: #666; display: block; margin-top: 5px;">
            Enter the full URL you want to shorten (must start with http:// or https://)
        </small>
    </div>

    <div style="display: flex; gap: 10px;">
        <button type="submit" class="btn">Generate Short URL</button>
        <a href="{{ route('short-urls.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
@endsection
