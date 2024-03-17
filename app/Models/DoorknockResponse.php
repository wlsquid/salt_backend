<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoorknockResponse extends Model
{
    use HasFactory;

    
    const Meaningful = 1;
    const NoAnswer = 2;
    const Busy = 3;
    const NotInterested = 4;
    const Inaccessible = 5;
    const BadInfo = 6;
    const Refused = 7;
}
