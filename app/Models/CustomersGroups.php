<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class CustomersGroups extends Pivot
{
    use HasTimestamps;
    protected $fillable = [
        "customer_id",
        "group_id",
    ];
}
