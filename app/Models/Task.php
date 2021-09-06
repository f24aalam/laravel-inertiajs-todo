<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCompletedAttribute()
    {
        return !is_null($this->attributes['completed_at']);
    }
}
