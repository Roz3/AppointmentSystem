<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallSlip extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    protected $table = 'callslips';
    
    protected $fillable = [
        'student_id',
        'instructor_id',
        'counselor_id',
        'date',
        'time',
        'status',
       
    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

}
