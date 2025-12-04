<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mohon3 extends Model
{
    use HasFactory;

    // Define the table name (optional, Laravel can infer this automatically)
    protected $table = 'mohon3';

    // Define the fillable fields (columns that can be mass-assigned)
    protected $fillable = [
        'user_id',
        'dokumen2',
        'dokumen3'
    ];

    // Define the relationship to the User model (a 'mohon3' belongs to one user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // You may also add custom logic or accessors if needed
}
