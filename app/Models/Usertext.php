<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usertext extends Model
{
    use HasFactory;

    protected $table = 'usertext';
    protected $fillable = [
        'text',
        'page',
    ];
}