<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;
    public $table = 'laptops';

    protected $fillable = [
        'type',
        'price',
        'stock',
        'name',
    ];
}
