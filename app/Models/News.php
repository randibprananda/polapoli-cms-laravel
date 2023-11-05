<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = "news";
    protected $fillable = [
        "title",
        "slug",
        "short_description",
        "content",
        "keyword",
        "category_id",
        "picture",
        "status",
        "user_id",
        "description"
    ];

    public function category()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
