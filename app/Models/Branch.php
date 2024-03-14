<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Location'
    ];

    public function manager():HasOne
    {
        return $this->hasOne(Manager::class,'Branch_id');
    }
    public function students():HasMany{
        return $this->hasMany(Student::class,'Branch_id');
    }
    public function course():HasMany{
        return $this->hasMany(Course::class,'Branch_id');
    }
}
