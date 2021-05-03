<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'assign_to', 'starting_date', 'ending_date '];


    public function depts()
    {
        return $this->HasOne(Dept::class);
    }
}
