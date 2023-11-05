<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class USP extends Model
{
    use HasFactory;
    protected $table = "u_s_p_s";
    protected $fillable = [
        "title",
        "description",
        "picture",
        "status",
        "user_id",
    ];
}
