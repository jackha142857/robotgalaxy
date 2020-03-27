<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
                  'email',
                  'email_verified_at',
                  'password',
                  'phone',
                  'address',
                  'dob',
                  'avatar',
                  'privilege',
                  'remember_token'
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
     * Get the comment for this model.
     */
    public function comment()
    {
        return $this->hasOne('App\Models\Comment','user_id','id');
    }

    /**
     * Get the mail for this model.
     */
    public function mail()
    {
        return $this->hasOne('App\Models\Mail','user_id','id');
    }

    /**
     * Get the report for this model.
     */
    public function report()
    {
        return $this->hasOne('App\Models\Report','user_id','id');
    }

    /**
     * Get the robot for this model.
     */
    public function robot()
    {
        return $this->hasOne('App\Models\Robot','user_id','id');
    }

    /**
     * Get the savedList for this model.
     */
    public function savedList()
    {
        return $this->hasOne('App\Models\SavedList','user_id','id');
    }

    /**
     * Set the email_verified_at.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = !empty($value) ? \DateTime::createFromFormat('j/n/Y', $value) : null;
    }

    /**
     * Set the dob.
     *
     * @param  string  $value
     * @return void
     */
    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = !empty($value) ? \DateTime::createFromFormat('j/n/Y', $value) : null;
    }

    /**
     * Get email_verified_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getEmailVerifiedAtAttribute($value)
    {
        return !empty($value) ? \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y') : null;
    }

    /**
     * Get dob in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getDobAttribute($value)
    {
        return !empty($value) ? \DateTime::createFromFormat($this->getDateFormat1(), $value)->format('j/n/Y') : null;
    }

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedAtAttribute($value)
    {
        return !empty($value) ? \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y') : null;
        
    }

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return !empty($value) ? \DateTime::createFromFormat($this->getDateFormat(), $value)->format('j/n/Y') : null;
    }
    
    public function getDateFormat1()
    {
        return 'Y-m-d';
    }

}
