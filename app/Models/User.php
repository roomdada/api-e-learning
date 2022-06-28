<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'identifier',
    'first_name',
    'last_name',
    'email',
    'contact',
    'avatar',
    'badge',
    'role_id',
    'country_id',
    'gender',
    'birthday',
    'latest_logged_at',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];


  public function role(): BelongsTo
  {
    return $this->belongsTo(Role::class);
  }

  public function country(): BelongsTo
  {
    return $this->belongsTo(Country::class);
  }


  public function publications() : HasMany
  {
    return $this->hasMany(Publication::class);
  }

  public function activities() : HasMany
  {
    return $this->hasMany(Activity::class);
  }

}
