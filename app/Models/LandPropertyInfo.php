<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandPropertyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'land_property_id',
        'cadastre_number',
        'land_usage',
        'total_area',
        'survey_date',
    ];

    public function landPropertyInfo(): BelongsTo
    {
        return $this->belongsTo(LandProperty::class, 'land_property_id');
    }
}
