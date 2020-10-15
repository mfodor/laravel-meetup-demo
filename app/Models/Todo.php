<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'done'];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'done' => 'boolean',
    ];

    public function owner() {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Builder|Todo $builder
     */
    public function scopeUndone(Builder $builder) {
        $builder->whereDone(false);
    }

    /**
     * @param Builder|Todo $builder
     */
    public function scopeDone(Builder $builder) {
        $builder->whereDone(true);
    }
}
