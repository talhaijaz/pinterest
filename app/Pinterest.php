<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pinterest extends Model
{
    protected $table = 'pinterest';

    protected $fillable = ['user_id', 'token'];
}
