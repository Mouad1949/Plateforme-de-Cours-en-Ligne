<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;
    protected $fillable = ['title','description'];

    public function etudent()
     { 
      return $this->belongsToMany(User::class,'users_cour','cour_id','user_id'); 
    }

    public function teacher(){
      return $this->belongsTo(User::class);
    }
}
