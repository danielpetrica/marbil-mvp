<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            Groups::class,
            'customers_group',
            'customer_id',
            'group_id'
        )->using(CustomersGroups::class);
    }


}
