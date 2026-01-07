<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    // --- THIS WAS MISSING ---
    // We must tell Laravel it is safe to save these 3 columns
    protected $fillable = [
        'description',
        'amount',
        'date'
    ];
}
