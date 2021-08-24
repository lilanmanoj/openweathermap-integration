<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;

    public const FACTOR = 273.15;

    protected $fillable = [
        'city_id',
        'city_name',
        'user_id',
        'temperature',
    ];

    protected $hidden = [
        'updated_at',
    ];

    protected $appends = [
        'celsius',
        'fahrenheit',
    ];

    /**
     * Convert and get temperature in celsius.
     *
     * @return string
     */
    public function getCelsiusAttribute()
    {
        $value = $this->temperature - self::FACTOR;

        return number_format($value);
    }

    /**
     * Convert and get temperature in fahrenheit.
     *
     * @return string
     */
    public function getFahrenheitAttribute()
    {
        $value = ($this->temperature - self::FACTOR) * 9 / 5 + 32;

        return number_format($value);
    }
}
