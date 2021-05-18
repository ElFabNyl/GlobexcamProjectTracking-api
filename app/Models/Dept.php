<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount_to_pay',
        'amount_payed',
        'user_id',
        'projet_id',
    ];

    public function projet()
    {
        return $this->HasOne(Projet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }
}
