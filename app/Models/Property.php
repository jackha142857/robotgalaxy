<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'properties';

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
                  'name',
                  'input_type_id',
                  'description',
                  'order',
                  'filter'
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
     * Get the InputType for this model.
     */
    public function InputType()
    {
        return $this->belongsTo('App\Models\InputType','input_type_id','id');
    }

    /**
     * Get the filter for this model.
     *
     * @return App\Models\Filter
     */
//     public function filter()
//     {
//         return $this->hasOne('App\Models\Filter','property_id','id');
//     }

    /**
     * Get the option for this model.
     */
    public function options()
    {
        return $this->hasMany('App\Models\Option','property_id','id');
    }

    /**
     * Get the robotInfo for this model.
     */
    public function robotInfo()
    {
        return $this->hasOne('App\Models\RobotInfo','property_id','id');
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
