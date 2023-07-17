<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class CustomersGroups extends Pivot
{
    use HasTimestamps;
    protected $fillable = [
        "customer_id",
        "group_id",
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Groups::class);
    }
}
