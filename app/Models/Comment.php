<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $table = 'comment';
    protected $fillable = ['message', 'idpost', 'iduser'];
    
    
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'iduser');
    }
    
    public function post() {
        return $this->belongsTo('App\Models\Post', 'idpost');
    }
}
