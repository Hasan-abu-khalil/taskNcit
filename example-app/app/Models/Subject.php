<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['name','minimun_mark','mark'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'student_subjects', 'subject_id', 'user_id');
    }
}
