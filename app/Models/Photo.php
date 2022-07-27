<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table = "photos"; //これを追加！
    protected $fillable = ['path','date']; //これを追加！

    public function Players()
    {
        return $this->belongsToMany('App\Models\Player')->withTimestamps();
    }
}
