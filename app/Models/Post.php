<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
        'image_url',
        'author_name',
        'read_time',
        'is_published',
    ];

    /**
     * Get primary image URL, handling local storage paths with asset().
     */
    public function getImageUrlAttribute(?string $value): ?string
    {
        if (! $value) {
            return 'https://placehold.co/800x600/f0fdf4/166534?text=MiniMart+Blog';
        }

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        return asset($value);
    }
}
