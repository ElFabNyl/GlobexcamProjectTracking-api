<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'assign_to',
        'ending_date',
        'user_id',
        'client_email',
        'general_price',
        'amount_payed',
        'slug',
        'status',
        'category'
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

    public static function findBySlug($slug)
    {
      return  DB::table('projets')
          ->select('*')
          ->where('slug','=',$slug)
          ->first();
    }
}
