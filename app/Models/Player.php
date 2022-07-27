<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    // protected $table = "players"; //これを追加！
    protected $fillable = ['name_kanji','name_kana','nickname','number']; //これを追加！

    public function Photos()
    {
        return $this->belongsToMany('App\Models\Photo')->withTimestamps();
    }

}
