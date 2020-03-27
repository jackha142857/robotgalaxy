<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RobotInfo extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'robot_infos';

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
                  'robot_id',
                  'property_id',
                  'content'
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
     * Get the Robot for this model.
     */
    public function Robot()
    {
        return $this->belongsTo('App\Models\Robot','robot_id','id');
    }

    /**
     * Get the Property for this model.
     */
    public function Property()
    {
        return $this->belongsTo('App\Models\Property','property_id','id');
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
