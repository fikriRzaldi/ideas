<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    // berguna untuk menentukan field mana saja yang tidak boleh diisi
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    // berguna untuk menentukan field mana saja yang boleh diisi
    // protected $fillable = [
    //     'content',
    //     'likes',
    // ];

    public function comments()
    {
        return $this->hasMany(Comment::class); // This will return all comments that belong to the idea
    }

    public function user()
    {
        return $this->belongsTo(User::class); // This will return the user that created the idea
    }
}
