<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'slug',
      'description',
      'duration',
      'price',
      'category_id',
      'image_path',
      'posted_at',
      'point',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function quizzes() : HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function modules() : HasMany
    {
        return $this->hasMany(Module::class);
    }
}
