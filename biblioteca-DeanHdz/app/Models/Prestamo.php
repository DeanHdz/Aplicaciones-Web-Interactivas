<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

Class Prestamo{

    use HasFactory, Notifiable;

    protected $fillable = ['user_id', 'libro_id'];

}