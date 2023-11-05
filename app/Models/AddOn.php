<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOn extends Model
{
    use HasFactory;
    protected $table = "add_ons";
    protected $cascadeDeletes = ['select_add_on'];
    protected $fillable = [
        "user_id",
        "title",
        "slug",
        "price",
        "periode",
        "status",
        "description",
    ];

    public function select_add_on()
    {
        return $this->hasMany(SelectAddOn::class);
    }
}
