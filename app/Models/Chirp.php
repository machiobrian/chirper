<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chirp extends Model
{
    // use HasFactory;
    protected $fillable = ['message']; // enable mass assignment for the message attribute
}
