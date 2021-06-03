<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $fillable = ['user_id', 'invoice_id', 'details', 'amount', 'tax', 'total_amount', 'status', 'invoice'];

    protected $casts = [
        'details' => 'array',
        'amount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    public function getCreatedAtAttribute() {
        return \Carbon\Carbon::parse($this->attributes['created_at'])->isoFormat('MMMM Do YYYY');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
