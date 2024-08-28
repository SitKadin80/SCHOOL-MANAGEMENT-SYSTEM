<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'name',
        'room_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    public function room(){
        return $this->belongsTo(Room::class);
    }
}
