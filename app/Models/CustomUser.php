<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomUser extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'custom_users';
    protected $fillable = [
        'name', 'email', 'password', 'photo'
    ];
   public function addresses()
{
    return $this->hasMany(UserAddress::class, 'user_id'); // Specify the custom foreign key name
}
}
