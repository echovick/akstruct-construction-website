<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'department',
        'location',
        'description',
        'responsibilities',
        'requirements',
        'benefits',
        'salary_min',
        'salary_max',
        'is_remote',
        'is_active',
        'valid_until',
    ];

    protected $casts = [
        'is_remote'   => 'boolean',
        'is_active'   => 'boolean',
        'valid_until' => 'datetime',
        'salary_min'  => 'decimal:2',
        'salary_max'  => 'decimal:2',
    ];

    // Scope to get only active job postings
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('valid_until')
                    ->orWhere('valid_until', '>=', now());
            });
    }
}
