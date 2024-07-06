<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    use HasFactory;
    protected $table = 'user_services';
    protected $fillable = [
        'id',
        'user_id',
        'service_id',
        'status',
        'comment',

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function user_services()
    {
        return $this->belongsTo(UserService::class, 'id');
    }

}
