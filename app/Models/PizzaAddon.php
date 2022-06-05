<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaAddon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'manufacturer_id',
        'pizza_model_id',
        'name',
        'description',
        'image',
        'value',
        'is_active'
    ];

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class);
    }

    public function pizzaModel(){
        return $this->belongsTo(PizzaModel::class);
    }
}
