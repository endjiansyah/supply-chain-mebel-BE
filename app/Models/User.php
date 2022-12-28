<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;
    public $guarded = ['id'];
    protected $table = "user";

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {

            $hash = Hash::make($user->password);

            $user->password = $hash;
        });

        self::updating(function ($user) {
            if ($user->isDirty(["password"])) {
                $hash = Hash::make($user->password);
                $user->password = $hash;
            }
        });
    }
}
