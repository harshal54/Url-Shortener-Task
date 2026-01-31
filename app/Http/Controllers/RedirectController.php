<?php

namespace App\Http\Controllers;

use App\Services\ShortUrlService;

class RedirectController extends Controller
{
    public function __construct(
        private ShortUrlService $shortUrlService
    ) {}

    public function redirect(string $shortCode)
    {
        $shortUrl = $this->shortUrlService->resolveAndTrack($shortCode);
    //     echo '<pre>';
    //    print_r($shortUrl);die;
        if (!$shortUrl) {
            abort(404, 'Short URL not found.');
        }

        return redirect($shortUrl->original_url);
    }
}
