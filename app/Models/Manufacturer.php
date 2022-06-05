<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active'
    ];

    // Manufacturer has many pizza models
    public function pizzaModels(){
        return $this->hasMany(PizzaModel::class, 'manufacturer_id');
    }
}