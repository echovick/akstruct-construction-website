<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'department',
        'bio',
        'email',
        'phone',
        'image',
        'social_links',
        'sort_order',
        'published',
    ];

    protected $casts = [
        'published'    => 'boolean',
        'social_links' => 'array',
    ];

    protected $attributes = [
        'published'  => true,
        'sort_order' => 0,
    ];
}
