<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

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
        'year',
        'client',
        'area',
        'duration',
        'floors',
        'status',
        'cost',
        'sustainability_focus',
        'image_path',
        'featured_image',
        'gallery',
        'gallery_images',
        'highlights',
        'completion_certificate',
        'case_study_pdf',
        'is_featured',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured'    => 'boolean',
        'gallery'        => 'array',
        'gallery_images' => 'array',
        'highlights'     => 'array',
        'cost'           => 'decimal:2',
        'completed_at'   => 'datetime',
    ];

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
