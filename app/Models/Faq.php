<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'display_order',
        'is_published',
    ];

    protected $casts = [
        'is_published'  => 'boolean',
        'display_order' => 'integer',
    ];

    // Scope to get only published FAQs
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope to order by display_order
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }
}
