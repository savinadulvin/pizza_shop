<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer_id',
        'pizza_model_id',
        'size_id',
        'name',
        'summary',
        'price',
        'description',
        'image',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    public function size(){
        return $this->belongsTo(PizzaSize::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function pizzaModel()
    {
        return $this->belongsTo(PizzaModel::class);
    }
}