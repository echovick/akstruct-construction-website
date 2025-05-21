<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'position',
        'company',
        'content',
        'image',
        'video_url',
        'audio_url',
        'is_featured',
        'rating',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'rating'      => 'integer',
    ];
}
