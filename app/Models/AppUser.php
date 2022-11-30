<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Token;
use App\Models\Notification;

class AppUser extends Model
{
    use HasFactory;
    protected $table = 'app_users';
    public $timestamps = false;

    public function token()
    {
        return $this->hasOne(Token::class, 'user_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }
}
