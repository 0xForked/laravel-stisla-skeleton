<?php

namespace App\Models\Activity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Access extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'access_activities';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'userType',
        'userId',
        'route',
        'ipAddress',
        'userAgent',
        'locale',
        'referer',
        'methodType',
    ];

    protected $casts = [
        'description'   => 'string',
        'user'          => 'integer',
        'route'         => 'string',
        'ipAddress'     => 'ipAddress',
        'userAgent'     => 'string',
        'locale'        => 'string',
        'referer'       => 'string',
        'methodType'    => 'string',
    ];

    /**
     * An activity has a user.
     *
     * @var array
     */
    public function user()
    {
        return $this->hasOne("App\Models\User");
    }

    /**
     * Get a validator for an incoming Request.
     *
     * @param array $merge (rules to optionally merge)
     *
     * @return array
     */
    public static function rules($merge = [])
    {
        return array_merge([
            'description'   => 'required|string',
            'userType'      => 'required|string',
            'userId'        => 'nullable|integer',
            'route'         => 'nullable|url',
            'ipAddress'     => 'nullable|ip',
            'userAgent'     => 'nullable|string',
            'locale'        => 'nullable|string',
            'referer'       => 'nullable|string',
            'methodType'    => 'nullable|string',
        ], $merge);
    }

}
