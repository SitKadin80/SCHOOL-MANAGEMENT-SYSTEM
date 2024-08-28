<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',

    ];

    // In Teacher.php model
    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

}
