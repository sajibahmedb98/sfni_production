<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppUser;

class Token extends Model
{
    use HasFactory;
    protected $table = 'tokens';
    public $timestamps = false;


    public function appUser()
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }
}
