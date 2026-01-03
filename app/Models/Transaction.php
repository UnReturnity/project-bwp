<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'transaction_date'];

    // Link to the user who bought it
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Link to the details (the list of breads bought)
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
