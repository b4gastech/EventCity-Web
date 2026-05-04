<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Tambahkan user_id dan kolom fitur Smart City lainnya di sini
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'location',
        'quota',
        'category',
        'event_date',
        'poster_path',
        'latitude',
        'longitude',
        'status',
    ];
}