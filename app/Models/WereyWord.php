<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wereyword extends Model
{
    protected $table = 'wereywords';

    protected $fillable = [ 'name' ];

    public function wordgroups ()
    {
        return $this->belongsToMany(Wordgroup::class);
    }
}
