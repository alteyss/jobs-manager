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
    
    protected $casts = [
        'resume' => 'array',
        'documents' => 'array'
    ];

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
        return $this->belongsTo(Degree::class);
    }

    /**
     * Get the state associated with the application.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the region associated with the application.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the department associated with the application.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the field associated with the application.
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * Get the job associated with the application.
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
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

    public function setResumeAttribute($value)
    {
        $attribute_name = "resume";
        $disk = "local";
        $destination_path = "resumes";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);

        // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }

    public function setDocumentsAttribute($value)
    {
        $attribute_name = "documents";
        $disk = "local";
        $destination_path = "documents";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);

        // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }
}
