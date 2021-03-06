<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookShop extends Model
{
    use HasFactory;

    protected $table = 'bookshops';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
