<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectAddOn extends Model
{
    use HasFactory;

    protected $table = "select_add_ons";

    protected $fillable = [
        'pricing_id',
        'add_on_id',
    ];

    public function pricing()
    {
        return $this->belongsTo(Pricing::class, 'pricing_id', 'id');
    }

    public function add_on()
    {
        return $this->belongsTo(AddOn::class, 'add_on_id', 'id');
    }
}
