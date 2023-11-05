<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = "divisions";
    protected $cascadeDeletes = ['pricing'];

    protected $fillable = [
        'name',
    ];

    public function pricing()
    {
        return $this->hasMany(Pricing::class);
    }
}
