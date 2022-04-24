<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use CrudTrait;
    use \Bkwld\Cloner\Cloneable;

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

    protected $cloneable_relations = ['targets'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function boot()
    {
        parent::boot();
        
        static::deleting(function($obj) {
            $is_admin = backpack_user()->hasRole('Admin');
            $is_master = is_null($obj->user_id);

            if ($is_admin && $is_master) {
                if (count((array)$obj->resume)) {
                    foreach ($obj->resume as $file_path) {
                        \Storage::disk('local')->delete($file_path);
                    }
                }
                
                if (count((array)$obj->documents)) {
                    foreach ($obj->documents as $file_path) {
                        \Storage::disk('local')->delete($file_path);
                    }
                }
            }
        });
    }

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

    /**
     * The targets that belong to the application.
     */
    public function targets()
    {
        return $this->belongsToMany(Target::class);
    }

    /**
     * Get the user associated with the application.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function setResumeAttribute($value, $ignore = false)
    {
        if ($ignore) {
            $this->attributes['resume'] = json_encode($value);
        } else {
            $attribute_name = "resume";
            $disk = "local";
            $destination_path = "resumes";

            $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);

            // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
        }
    }

    public function setDocumentsAttribute($value, $ignore = false)
    {
        if ($ignore) {
            $this->attributes['documents'] = json_encode($value);
        } else {
            $attribute_name = "documents";
            $disk = "local";
            $destination_path = "documents";
    
            $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    
            // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
        }
    }
}
