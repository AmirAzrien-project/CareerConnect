<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';

    protected $fillable = [
        'student_id',
        'failsatu',
        'faildua',
        'failtiga',
        'failempat',
        'statussatu',
        'statusdua',
        'statustiga',
    ];

    // Relationship with the student (assuming student is a user)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'user_id');  // Explicitly mention the foreign and local keys
    }
}
