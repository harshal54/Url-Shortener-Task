<?php

namespace App\Http\Controllers;

use App\Services\ShortUrlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{
    public function __construct(
        private ShortUrlService $shortUrlService
    ) {}

    public function index()
    {
        $user = Auth::user();
        // echo '<pre>';
        // print_r($user);
        // die;

        if ($user->isSuperAdmin()) {
            abort(403, 'SuperAdmin cannot create short URLs.');
        }

        $shortUrls = $this->shortUrlService->getVisibleUrls($user);
        return view('short-urls.index', compact('shortUrls', 'user'));
    }


    public function create()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            abort(403, 'SuperAdmin cannot create short URLs.');
        }

        return view('short-urls.create');
    }


    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            abort(403, 'SuperAdmin cannot create short URLs.');
        }

        $validated = $request->validate([
            'original_url' => ['required', 'url', 'max:2048'],
        ]);

        $shortUrl = $this->shortUrlService->createShortUrl($user, $validated['original_url']);

        return redirect()->route('short-urls.index')->with('success', "Short URL created: {$shortUrl->full_url}");
    }
}
