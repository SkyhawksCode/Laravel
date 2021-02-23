<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Battery extends Model
{
    use HasApiTokens, HasFactory;
    protected $fillable = ['wifi_mac', 'battery_level', 'user_id', 'last_user_id', 'pdaname', 'charge_status'];
}
