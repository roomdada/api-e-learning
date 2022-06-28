<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'parent_id',
    ];


    public function courses() : HasMany
    {
        return $this->hasMany(Course::class);
    }


    public function childrens() : HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    public function parent() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
