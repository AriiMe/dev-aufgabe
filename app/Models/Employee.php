<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;


    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }


    public function accessTokens()
    {
        return $this->hasMany(AccessToken::class);
    }
}
