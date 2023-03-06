<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LandProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'name',
        'cadastre_number',
        'status',
    ];

    public function people(): BelongsTo
    {
        return $this->belongsTo(People::class, 'people_id');
    }

    public function landPropertyInfo(): HasMany
    {
        return $this->hasMany(LandPropertyInfo::class, 'land_property_id', 'id');
    }
}
