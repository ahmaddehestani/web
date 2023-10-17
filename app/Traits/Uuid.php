<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Uuid
{
    protected static function bootUuid(): void
    {
        static::creating(function ($model) {
            if (!isset($model->uuid)) {
                $model->uuid = (string)Str::uuid();
            }
        });
    }

    /**
     * Scope a query to only include uuid.
     *
     * @param Builder $query
     * @param string  $uuid
     *
     * @return Builder
     */
    public function scopeOfUuid(Builder $query, string $uuid): Builder
    {
        return $query->where('uuid', $uuid);
    }
}
