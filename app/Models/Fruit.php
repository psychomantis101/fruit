<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fruit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')
            ->with('children')
            ->orderBy('name');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeAllFruits(Builder $query): Builder
    {
        return $query->whereNull('parent_id')
            ->with('children')
            ->orderBy('name');
    }
}
