<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcursionRequest extends Model
{
    use HasFactory;
      
    protected $fillable = [
        'nom',
        'email',
        'tel',
        'destination',
        'nbr_Pax',
        'date',
        'message',
        'confirmed',
    ];

    protected $casts = [
        'date' => 'date',
        'confirmed' => 'boolean',
    ];
}
