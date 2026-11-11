<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentRoster extends Model
{
    protected $table = 'student_rosters';
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'student_id',
        'student_name',
        'programme',
        'semester',
    ];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'student_id', 'student_id');
    }
}
