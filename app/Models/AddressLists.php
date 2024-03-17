<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressLists extends Model
{
    use HasFactory;

    protected $fillable = ["name", "archived"];
}
