<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'author',
        'reading_time',
        'is_published',
        'published_at',
        'tags',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'tags'         => 'array',
        'reading_time' => 'integer',
    ];

    // Auto-slugify from title when creating a new blog post
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (! $blog->slug) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    // Scope to get only published blogs
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    // Ensure we have a featured image, use fallback if needed
    public function getFeaturedImageAttribute($value)
    {
        // Check if image exists and is valid
        if ($value && file_exists(public_path($value))) {
            return $value;
        }

        // Map categories to default images
        $categoryImages = [
            'Sustainability'    => 'assets/img/blog/sustainable-future.jpg',
            'Tips'              => 'assets/img/blog/choosing-partner.jpg',
            'Project Updates'   => 'assets/img/blog/green-towers-case.jpg',
            'Construction News' => 'assets/img/blog/innovations.jpg',
        ];

        // Use category-based default image if available
        if (isset($categoryImages[$this->category])) {
            return $categoryImages[$this->category];
        }

        // Final fallback
        return 'assets/img/blog/default-blog.jpg';
    }
}
