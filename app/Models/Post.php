<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $table = 'post';
    
    protected $fillable = ['title', 'message', 'iduser'];
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'iduser');
    }
    
    public function comments() {
        return $this->hasMany('App\Models\Comment', 'idpost');
    }
}
