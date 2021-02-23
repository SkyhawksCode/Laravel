<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Pda extends Model
{
    use HasApiTokens, HasFactory;
    protected $fillable = ['wifimac', 'pdaname', 'description', 'purchaseddate', 'reference', 'batterylevel'];
}
