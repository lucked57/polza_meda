<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts'; // Change this to match your actual table name

    protected $fillable = [
        'title',
        'description',
        'main_img',
        'type',   
        'status_sold', 
        'email',
        'img_path_1',
        'img_path_2',
        'img_path_3',
        'img_path_4',
        'img_path_5',
        'img_path_6',
        'img_path_7',
        'img_path_8',
        'img_path_9',
    ];
}
