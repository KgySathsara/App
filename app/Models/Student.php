<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'Student Name',
        'Student Address',
        'Phone Number',
        'Branch_id'
    ];
    public function branch():BelongsTo
    {
        return $this->belongsTo(Branch::class,'Branch_id');
    }
}
