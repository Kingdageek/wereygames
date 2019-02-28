<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_stories';
    /**
     * Mass-assign fields
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'guest_id',
        'content',
        'story_id',
    ];

    /**
     * Hidden fields.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

}
