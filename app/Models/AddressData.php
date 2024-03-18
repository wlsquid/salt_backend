<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressData extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function addressVisits() {
        return $this->hasMany(AddressVisits::class)->orderBy('created_at', 'desc');
    }
}
