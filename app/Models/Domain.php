<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = ['name_host', 'name_customer', 'price', 'service','method_payment','verify','user_id'];


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
