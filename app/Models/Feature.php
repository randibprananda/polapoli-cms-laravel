<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $table = 'features';

    protected $fillable = [
        'pricing_id',
        'title',
        'status',
    ];

    public function pricing()
    {
        return $this->belongsTo(Pricing::class, 'pricing_id', 'id');
    }
}
