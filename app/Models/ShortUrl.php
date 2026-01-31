<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'short_code',
        'original_url',
        'click_count',
    ];

    protected $casts = [
        'click_count' => 'integer',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function incrementClickCount(): void
    {
        $this->increment('click_count');
    }

    public function getFullUrlAttribute(): string
    {
        return url($this->short_code);
    }
}
