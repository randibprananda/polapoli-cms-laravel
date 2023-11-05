<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    protected $table = "social_medias";
    protected $fillable = [
        "type",
        "account_name",
        "link",
    ];
}
