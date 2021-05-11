<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'assign_to',
        'starting_date',
        'ending_date',
        'user_id',
        'client_name',
        'general_price',
        'amount_payed',
        'slug'
    ];


    public function depts()
    {
        return $this->belongsTo(Dept::class);
    }

    public function comment()
    {
        return $this->HasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
