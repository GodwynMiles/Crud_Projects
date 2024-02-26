<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Item extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'items';

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'category_id',
    ];

}

class Item extends Model
{
    protected $fillable = ['name', 'description', 'price', 'quantity', 'category_id'];
}
