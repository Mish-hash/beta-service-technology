<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curency extends Model
{
    use HasFactory;

    const CREATED_AT = 'date';
    //const UPDATED_AT = 'updated_at';

    protected $table = 'currency';

    protected $fillable = [
        'valuteID',
        'numCode',
        'сharCode',
        'name',
        'value',
    ];
}
