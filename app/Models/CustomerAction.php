<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\CustomerStatus;
use Illuminate\Database\Eloquent\Model;


class CustomerAction extends Model
{
    protected $fillable = ['customer_id', 'action', 'notes'];

    protected $casts = [
        'action' => CustomerStatus::class,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}