<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mohon extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's naming convention
    protected $table = 'mohon';

    // Fillable fields for mass assignment
    protected $fillable = ['id', 'user_id', 'name', 'no_ic', 'phone_number', 'email', 'student_course', 'part', 'pointer', 'student_address', 'parents', 'parents_address', 'parents_number', 'date', 'dokumen_mohon', 'cover_letter'];

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
