<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    public function photo(){
        return $this->hasOne(Photo::class,'id','id_photo');
    }

    public function user(){
        return $this->hasOne(User::class,'id','id_user');
    }
}
