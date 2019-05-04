<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wordgroup extends Model
{
    protected $table = 'wordgroups';

    protected $fillable = [ 'name' ];

    public function wereywords ()
    {
        return $this->belongsToMany(Wereyword::class);
    }
}
