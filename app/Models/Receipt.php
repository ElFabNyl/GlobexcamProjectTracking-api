<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    public $fillable = [
        'dept_id',
        'phase',
        'amount_payed',
        'method_payment'
    ];

    public function dept()
    {
        return $this->HasOne(Dept::class);
    }
}
