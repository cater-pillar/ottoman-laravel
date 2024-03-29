<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait IsSelfReferencing
{


    /**
     * The belongsTo parent relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(static::class, $this->referenceKey);
    }

    /**
     * The hasMany children relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, $this->referenceKey);
    }

    /**
     * The hasMany descendants relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    /**
     * Determine if the record has no parent.
     *
     * @return bool
     */
    public function isRoot()
    {
        return is_null($this->{$this->referenceKey});
    }

    /**
     * Determine if the record is a child of another.
     *
     * @return bool
     */
    public function isChild()
    {
        return !$this->isRoot();
    }

    /**
     * Scope the query for root entries only.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeRoots(Builder $query)
    {
        return $query->whereNull($this->referenceKey);
    }
}