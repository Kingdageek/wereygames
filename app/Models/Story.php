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
        'content',
        'featured_photo',
        'form'
    ];

    /**
     * Hidden fields.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    public function getFeaturedImageAttribute()
    {
        $featured_image = $this->featured_photo;
        if (!$featured_image || is_null($featured_image)) {
            $url = url('assets/front/img/work-2.jpg');
        }else{
            $url = url('uploads/' . $featured_image);
        }

        return $url;
    }
}
