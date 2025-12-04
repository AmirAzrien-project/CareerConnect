<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selia extends Model
{
    use HasFactory;

    protected $table = 'selia';

    protected $fillable = [
        'id',
        'user_id',
        'penyelia_id',
        'student_id',
        'name',
        'penyelia_name',
        'student_name',
        'no_ic',
    ];

    // Relationship to Penyelia (Supervisor)
    public function penyelia()
    {
        return $this->belongsTo(User::class, 'penyelia_id', 'user_id'); // Penyelia's User ID
    }

    // Relationship to Student
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'user_id'); // Student's User ID
    }

    public function terima()
    {
        return $this->hasOne(Terima::class, 'user_id','student_id', 'student_id'); // Adjust accordingly if 'terima' has different key
    }
}
