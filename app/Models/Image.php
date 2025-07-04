<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['page', 'imagename'];

    public $timestamps = true; // Ensures Laravel updates created_at & updated_at
}
