<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVacancy extends Model
{

    use HasFactory;
    protected $table = 'user_vacancy';
    protected $fillable = [
        'user_id',
        'vacancy_id',
        'resume',
        'comment',
        'date_interview',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class, 'vacancy_id');
    }
}
