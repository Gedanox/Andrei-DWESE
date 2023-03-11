<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $table = 'review';
    
    protected $fillable = ['title', 'type', 'review', 'iduser'];
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'iduser');
    }
    
    public function comments() {
        return $this->hasMany('App\Models\Comment', 'idreview');
    }
    
    public function images() {
        return $this->hasMany('App\Models\Image', 'idreview');
    }
}
