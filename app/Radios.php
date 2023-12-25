<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @property int    $id
 * @property int    $channel_cat_id
 * @property int    $status
 * @property string $channel_access
 * @property string $radio_name
 * @property string $radio_slug
 * @property string $radio_description
 * @property string $radio_thumb
 * @property string $radio_url_type
 * @property string $radio_url
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keyword
 */
class Radios extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'radios';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'radio_cat_id', 'radio_access', 'radio_name', 'radio_slug', 'radio_description', 'radio_thumb', 'radio_url_type', 'radio_url', 'seo_title', 'seo_description', 'seo_keyword', 'views', 'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'int', 'radio_cat_id' => 'int', 'radio_access' => 'string', 'radio_name' => 'string', 'radio_slug' => 'string', 'radio_description' => 'string', 'radio_thumb' => 'string', 'radio_url_type' => 'string', 'radio_url' => 'string', 'seo_title' => 'string', 'seo_description' => 'string', 'seo_keyword' => 'string', 'status' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [

    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    // Scopes...

    // Functions ...

    // Relations ...
}
