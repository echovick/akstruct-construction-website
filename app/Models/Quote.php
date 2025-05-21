<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'project_type',
        'budget_range',
        'message',
        'drawings_specs',
        'status',
        'admin_notes',
    ];

    // Define possible status values
    public const STATUS_NEW         = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED   = 'completed';
    public const STATUS_DECLINED    = 'declined';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_NEW         => 'New',
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_COMPLETED   => 'Completed',
            self::STATUS_DECLINED    => 'Declined',
        ];
    }
}
