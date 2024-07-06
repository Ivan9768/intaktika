<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'vacancy',
        'intro',
        'duties',
        'requirements',
        'conditions',
        'active'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_vacancy')
            ->withPivot('vacancy')
            ->withTimestamps();
    }
}
