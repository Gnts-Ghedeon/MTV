<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $pd_access
 * @property string $pd_genre_id
 * @property string $pd_title
 * @property string $duration
 * @property string $pd_description
 * @property string $pd_slug
 * @property string $pd_image_thumb
 * @property string $pd_image
 * @property string $pd_url
 * @property string $download_url
 * @property string $imdb_id
 * @property string $imdb_rating
 * @property string $imdb_votes
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keyword
 * @property string $content_rating
 * @property int    $video_quality
 * @property int    $download_enable
 * @property int    $status
 * @property int    $created_at
 * @property int    $updated_at
 */
class Podcasts extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'podcats';

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
        'pd_access', 'pd_genre_id', 'pd_title', 'duration', 'pd_description', 'pd_slug', 'pd_image_thumb', 'pd_image', 'video_quality', 'pd_url', 'download_enable', 'download_url', 'imdb_id', 'imdb_rating', 'imdb_votes', 'seo_title', 'seo_description', 'seo_keyword', 'views', 'content_rating', 'status', 'created_at', 'updated_at'
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
        'pd_access' => 'string', 'pd_genre_id' => 'string', 'pd_title' => 'string', 'duration' => 'string', 'pd_description' => 'string', 'pd_slug' => 'string', 'pd_image_thumb' => 'string', 'pd_image' => 'string', 'video_quality' => 'int', 'pd_url' => 'string', 'download_enable' => 'int', 'download_url' => 'string', 'imdb_id' => 'string', 'imdb_rating' => 'string', 'imdb_votes' => 'string', 'seo_title' => 'string', 'seo_description' => 'string', 'seo_keyword' => 'string', 'content_rating' => 'string', 'status' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
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
