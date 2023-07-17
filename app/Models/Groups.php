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
}
