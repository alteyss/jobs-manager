<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'applications';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Get the degree associated with the application.
     */
    public function degree()
    {
        return $this->hasOne(Degree::class);
    }

    /**
     * Get the state associated with the application.
     */
    public function state()
    {
        return $this->hasOne(State::class);
    }

    /**
     * Get the region associated with the application.
     */
    public function region()
    {
        return $this->hasOne(Region::class);
    }

    /**
     * Get the department associated with the application.
     */
    public function department()
    {
        return $this->hasOne(Department::class);
    }

    /**
     * Get the field associated with the application.
     */
    public function field()
    {
        return $this->hasOne(Field::class);
    }

    /**
     * Get the job associated with the application.
     */
    public function job()
    {
        return $this->hasOne(Job::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
