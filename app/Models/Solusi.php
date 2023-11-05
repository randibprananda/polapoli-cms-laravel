<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    use HasFactory;
    protected $table = "solusis";
    protected $fillable = [
        "title",
        "description",
        "picture",
        "status",
        "user_id",
    ];
}
