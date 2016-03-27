<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    protected $table = 'leaderboard';

    protected $hidden = ['id','identifier','identifier_type','updated_at'];

    protected $fillable = ['score','match_type'];
}
