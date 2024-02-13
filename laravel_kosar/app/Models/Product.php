<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';

    protected $fillable = [
        'type_id',
        'quantity',
        'date',
    ];

    public function basket()
    {
        return $this->hasMany(Basket::class, 'item_id', 'item_id');
    }

    public function products()
    {
        return $this->belongsTo(ProductType::class, 'item_id', 'item_id');
    }
}
