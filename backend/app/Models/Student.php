<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'student';

    protected $fillable = [
        'name',
        'email',
        'birth_date',
        'enable',
        'school_class_id'
    ];

    protected $casts = [
        'enable' => 'boolean',
        'birth_date' => 'date:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function schoolClasses()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }
}
