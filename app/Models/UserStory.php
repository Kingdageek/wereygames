<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class UserStory extends Model implements ViewableContract
{
    use Viewable;
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
