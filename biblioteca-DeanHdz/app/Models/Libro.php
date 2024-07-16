<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

Class Libro{

    use HasFactory, Notifiable;

    protected $fillable = ['name'];

}