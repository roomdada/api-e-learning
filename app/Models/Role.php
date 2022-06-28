<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
    ];

    const ADMIN = 1;
    const LEARNER = 2;

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }

    public function scopeLearner($query)
    {
      return $this->users->whereIn('role_id', [self::LEARNER]);
    }
}
