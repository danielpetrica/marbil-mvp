<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class Customer extends Model
{
    use HasTimestamps;

    protected $fillable = [
        "email",
        "first_name",
        "last_name",
        "gender",
        "date_of_birth",
    ];

    protected $casts = [
        "date_of_birth" => "date",
    ];

    public function groups()
    {
        return $this->belongsToMany(Groups::class, 'customers_groups', 'customer_id', 'group_id')
            ->through(CustomersGroups::class);
    }


}
