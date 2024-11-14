<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Summary.
 *
 * In summary, this code is part of a functionality that automatically generates and sets a unique slug for a model based on a specified source column (slugSourceColumn).
 * It ensures that this happens both when a new model instance is created and when an existing instance is updated,
 * and it enforces that the source column for the slug must be explicitly specified in the model.
 */
trait HasSlug
{
    protected static function bootHasSlug()
    {
        static::creating(function ($model) {
            if (!isset($model->slugSourceColumn)) {
                throw new \InvalidArgumentException('Slug source column is not defined in the model.');
            }

            $sourceValue = $model->{$model->slugSourceColumn} ?: Str::random(8);
            $model->slug = $model->generateUniqueSlug($sourceValue);
        });

        static::updating(function ($model) {
            if (!isset($model->slugSourceColumn)) {
                throw new \InvalidArgumentException('Slug source column is not defined in the model.');
            }

            $sourceValue = $model->{$model->slugSourceColumn} ?: Str::random(8);
            $model->slug = $model->generateUniqueSlug($sourceValue);
        });
    }

    private function generateUniqueSlug($value)
    {
        $slug = Str::slug($value);
        $counter = 1;

        while ($this->slugExists($slug)) {
            $slug = Str::slug($value) . '-' . $counter;
            $counter++;
            Log::info("Trying slug: $slug");
        }
        return $slug;
    }

    private function slugExists($slug)
    {
        return DB::table($this->getTable())
            ->where('slug', $slug)
            ->where('id', '!=', $this->id)
            ->exists();
    }
}