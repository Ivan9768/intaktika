<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'intro',
        'info',
        'img',
        'active'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_services')
            ->withPivot('title')
            ->withTimestamps();
    }
}
