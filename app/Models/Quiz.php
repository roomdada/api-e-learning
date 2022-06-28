<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
  use HasFactory;
  protected $guarded = [];


  public function course(): BelongsTo
  {
    return $this->belongsTo(Course::class);
  }


  public function questions(): HasMany
  {
    return $this->hasMany(Question::class);
  }
}
