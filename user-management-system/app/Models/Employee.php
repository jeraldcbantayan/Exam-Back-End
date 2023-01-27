<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['firstname', 'lastname','address','postcode', 'mobile', 'email', 'username', 'password'];

    use HasFactory;

}
