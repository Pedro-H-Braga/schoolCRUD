<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'school_class';

    protected $fillable = [
        'name',
        'year',
        'school_term',
        'enable',
    ];

    protected $casts = [
        'enable' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'school_class_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($schoolClass) {
            if ($schoolClass->isForceDeleting()) {
                $schoolClass->students()->delete();
            } else {
                $schoolClass->students()->update(['enable' => false]);
            }
        });
    }
}
