<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = ['fullname', 'country', 'address', 'state', 'city', 'postcode', 'phone'];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
