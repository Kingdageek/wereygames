<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stories';
    /**
     * Mass-assign fields
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content'
    ];

    /**
     * Hidden fields.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
}
