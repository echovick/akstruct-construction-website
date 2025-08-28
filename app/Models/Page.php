<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'title',
        'description',
        'content',
        'template',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'content'      => 'array',
        'is_published' => 'boolean',
        'sort_order'   => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->name);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('name') && ! $page->isDirty('slug')) {
                $page->slug = Str::slug($page->name);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
