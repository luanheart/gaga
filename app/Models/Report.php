<?php

namespace App\Models;

class Report extends Model
{

    protected $fillable = ['user_id', 'target_user_id', 'img', 'reason'];

}
