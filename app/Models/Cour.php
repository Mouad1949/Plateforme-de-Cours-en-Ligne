<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;
    protected $table = ['title','module'];

    public function user()
     { 
      return $this->belongsTo(User::class); 
    }
}
