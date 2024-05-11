<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    // berguna untuk menentukan field mana saja yang boleh diisi
    protected $fillable = [
        'content',
        'likes',
    ];
}
