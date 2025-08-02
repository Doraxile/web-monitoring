<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'uom', 'qty'];

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
