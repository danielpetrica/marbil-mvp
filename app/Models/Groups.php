<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class Groups extends Model
{
    use HasTimestamps;
    protected $fillable = [
        "name",
    ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customers_groups', 'group_id', 'customer_id')
            ->through(CustomersGroups::class);
    }
}
