<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'manufacturer_id',
        'name',
        'description',
        'image',
        'is_active'
    ];

    // Pizza model belongs to a manufacturer
    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }
    public function pizzaAddons(){
        return $this->hasMany(PizzaAddon::class, 'pizza_model_id');
    }
}
