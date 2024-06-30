<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'table',
        'customer_name',
        'total_price',
    ];
    use HasFactory;
    public function menus()
    {
        // return $this->belongsToMany(Menu::class);
        return $this->belongsToMany(Menu::class, 'order_menus')
            ->withPivot('quantity', 'price', 'note');
    }
}
