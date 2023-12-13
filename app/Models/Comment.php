<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CommentsControlle;


class comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'post_id', 'user_id'];


public function  post(){
    return $this->belongsTo(comment::class);
}

public function  user(){
    return $this->belongsTo(User::class);
}


}
