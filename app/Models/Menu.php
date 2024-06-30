<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'price',
        'type',
        'description',
        'image'
    ];
    use HasFactory;
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_menus')
            ->withPivot('quantity', 'price', 'note');
    }
}
