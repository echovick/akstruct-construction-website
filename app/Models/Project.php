<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    /**
     * Project status constants
     */
    const STATUS_DRAFT       = 'draft';
    const STATUS_PLANNING    = 'planning';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED   = 'completed';
    const STATUS_ON_HOLD     = 'on_hold';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'category_id',
        'location',
        'map_coordinates',
        'google_maps_url',
        'year',
        'client',
        'developer',
        'architect',
        'contractor',
        'area',
        'duration',
        'timeline',
        'floors',
        'status',
        'cost',
        'sustainability_focus',
        'specifications',
        'image_path',
        'featured_image',
        'gallery',
        'gallery_images',
        'video_path',
        'highlights',
        'completion_certificate',
        'case_study_pdf',
        'is_featured',
        'is_published',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured'    => 'boolean',
        'is_published'   => 'boolean',
        'gallery'        => 'array',
        'gallery_images' => 'array',
        'highlights'     => 'array',
        'specifications' => 'array',
        'timeline'       => 'array',
        'cost'           => 'decimal:2',
        'completed_at'   => 'datetime',
    ];

    /**
     * Get all available statuses.
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT       => 'Draft',
            self::STATUS_PLANNING    => 'Planning',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED   => 'Completed',
            self::STATUS_ON_HOLD     => 'On Hold',
        ];
    }

    /**
     * Check if project is published.
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->is_published === true;
    }

    /**
     * Check if project is draft.
     *
     * @return bool
     */
    public function isDraft()
    {
        return $this->status === self::STATUS_DRAFT;
    }

    /**
     * Scope a query to only include published projects.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include draft projects.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDraft($query)
    {
        return $query->where('is_published', false);
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title') && ! $project->isDirty('slug')) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    /**
     * Get the category that owns the project.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
