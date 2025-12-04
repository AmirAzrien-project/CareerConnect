<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terima extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's naming convention
    protected $table = 'terima';

    // Fillable fields for mass assignment
    protected $fillable = ['id', 'user_id', 'name', 'date', 'dokumen_terima', 'latitude', 'longitude', 'company_name'];

    public function students()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id', 'id');
    }
}
