<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class Campaign extends Model
{
    use HasTimestamps;

    protected $fillable = [
        "name",
        "description",
        "subject",
        "body",
        "group_id",
        "template_id",
        "scheduled_at",
        "is_sent",
        "is_scheduled",
    ];

    protected $casts = [
        "scheduled_at" => "datetime",
    ];

    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Groups::class);
    }

    public function template(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

}
