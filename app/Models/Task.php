<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'int',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['completed'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($task) {
            $task->team_id = Auth::user()->currentTeam->id;
            $task->user_id = Auth::user()->id;
        });
    }

    /**
     * Task belongsTo to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Category relation to this task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope to get tasks where category is active.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActiveCategory($query)
    {
        return $query->whereHas('category', function($query) {
            return $query->active();
        });
    }

    /**
     * Scope a query to only include current team tasks.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTeam($query)
    {
        return $query->where('team_id', Auth::user()->currentTeam->id);
    }

    /**
     * Get the completed attribute
     *
     * @return boolean
     */
    public function getCompletedAttribute()
    {
        return !is_null($this->attributes['completed_at']);
    }
}
