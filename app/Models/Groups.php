<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Groups extends Model
{
    use HasTimestamps;

    protected $fillable = [
        "name",
    ];

    protected $with = ['customers'];
    /**
     * @return BelongsToMany
     */
    public function customers(): BelongsToMany
    {
        //$related, $through, $firstKey = null, $secondKey = null, $localKey = null, $secondLocalKey = null
        return  $this->belongsToMany(
            Customer::class,
            'customers_group',
            'group_id',
            'customer_id'
            )->using(CustomersGroups::class);
    }
}
