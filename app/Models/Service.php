<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'long_description',
        'is_featured',
        'display_order',
    ];

    protected $casts = [
        'is_featured'   => 'boolean',
        'display_order' => 'integer',
    ];
}
