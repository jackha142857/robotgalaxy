<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'robots';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'user_id',
                  'state'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the User for this model.
     */
    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    /**
     * Get the comment for this model.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment','robot_id','id');
    }

    /**
     * Get the report for this model.
     */
    public function reports()
    {
        return $this->hasMany('App\Models\Report','robot_id','id');
    }

    /**
     * Get the robotInfo for this model.
     */
    public function robotInfos()
    {
        return $this->hasMany('App\Models\RobotInfo','robot_id','id');
    }

    /**
     * Get the savedList for this model.
     */
    public function savedList()
    {
        return $this->hasMany('App\Models\SavedList','robot_id','id');
    }


    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y g:i A');
    }

}
