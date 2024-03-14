<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class course extends Model
{
    use HasFactory;
    protected $fillable = [
        'Course Name',
        'Lecture Name',
        'Branch_id'
    ];

    public function branch():BelongsTo{
        return $this->belongsTo(Branch::class,'Branch_id');
    }
}
