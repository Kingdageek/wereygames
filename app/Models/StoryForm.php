<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryForm extends Model
{

    protected $table = 'story_forms';

    protected $fillable = [
        'story_id',
        'name'
    ];
    /**
     * Story relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function story()
    {
    return $this->belongsTo(Story::class);
    }
}
