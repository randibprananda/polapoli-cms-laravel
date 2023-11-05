<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;
    protected $table = "pricings";
    protected $cascadeDeletes = ['select_add_on'];
    protected $fillable = [
        "title",
        "price",
        "duration",
        "feature",
        "status",
        "user_id",
        "quantity",
        "package_type",
        "division_id"
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function select_add_on()
    {
        return $this->hasMany(SelectAddOn::class, 'pricing_id', 'id');
    }

    public function features()
    {
        return $this->hasMany(Feature::class, 'pricing_id', 'id');
    }
}
