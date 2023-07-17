<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class Template extends Model
{
    use HasTimestamps;

    protected $fillable = [
        "name",
        "description",
        "subject",
        "body",
    ];

}
