<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Story;

class Wereyimage extends Model
{
    protected $fillable = [ 'path' ];

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}
