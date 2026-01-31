<?php

namespace App\Services;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Support\Str;

class ShortUrlService
{

    public function generateUniqueCode(int $length = 6): string
    {
        do {
            $code = Str::random($length);
        } while (ShortUrl::where('short_code', $code)->exists());

        return $code;
    }

    public function createShortUrl(User $user, string $originalUrl): ShortUrl
    {
        $shortCode = $this->generateUniqueCode();

        return ShortUrl::create([
            'company_id' => $user->company_id,
            'user_id' => $user->id,
            'short_code' => $shortCode,
            'original_url' => $originalUrl,
            'click_count' => 0,
        ]);
    }

    public function getVisibleUrls(User $user)
    {
        if ($user->isSuperAdmin()) {
            return ShortUrl::with(['user', 'company'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        if ($user->isAdmin()) {
            return ShortUrl::with(['user', 'company'])
                ->where('company_id', $user->company_id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return ShortUrl::with(['user', 'company'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function resolveAndTrack(string $shortCode): ?ShortUrl
    {
        $shortUrl = ShortUrl::where('short_code', $shortCode)->first();
        if ($shortUrl) {
            $shortUrl->incrementClickCount();
        }
        return $shortUrl;
    }
}
