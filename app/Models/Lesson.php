<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function content() : Attribute
    {
      return new Attribute(
        set: function ($value) {
          $this->attributes['content'] = json_encode($value);
        }
      );
    }
}
