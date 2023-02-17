<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    protected $table = 'tipos';
    
    protected $fillable = ['name', 'description','price', 'category', 'photo', 'created_at'];
}
