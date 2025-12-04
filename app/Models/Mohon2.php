<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mohon2 extends Model
{
    use HasFactory;

    protected $table = 'mohon2'; // Make sure this matches the actual table name

    // Define the fillable fields that can be mass-assigned
    protected $fillable = [
        'no_id',
        'user_id',
        'resume',
        'dokumen_mohon',
        'dokumen2',
        'dokumen3',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
        //return $this->belongsTo(User::class, 'user_id');
    }
}
