<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'konsumen_id');
    }
}
