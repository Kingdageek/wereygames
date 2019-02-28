<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'guests';
    /**
     * Mass-assign fields
     *
     * @var array
     */
    protected $fillable = [
        'identifier',
        'has_unlocked'
    ];

    /**
     * Hidden fields.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

}
