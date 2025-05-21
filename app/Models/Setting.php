<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
        'is_public',
        'type',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    // Define setting types
    public const TYPE_TEXT     = 'text';
    public const TYPE_TEXTAREA = 'textarea';
    public const TYPE_IMAGE    = 'image';
    public const TYPE_BOOLEAN  = 'boolean';
    public const TYPE_JSON     = 'json';

    // Get value with proper casting based on type
    public function getValueAttribute($value)
    {
        if ($this->type === self::TYPE_BOOLEAN) {
            return (bool) $value;
        }

        if ($this->type === self::TYPE_JSON) {
            return json_decode($value, true);
        }

        return $value;
    }

    // Set value with proper formatting based on type
    public function setValueAttribute($value)
    {
        if ($this->type === self::TYPE_JSON && is_array($value)) {
            $this->attributes['value'] = json_encode($value);
        } else {
            $this->attributes['value'] = $value;
        }
    }

    // Helper method to get setting by key
    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }
}
