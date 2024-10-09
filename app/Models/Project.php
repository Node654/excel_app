<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $with = ['type'];
    protected $table = 'projects';
    protected $casts = [
      'created_at_time' => 'date',
      'contracted_at' => 'date',
      'deadline' => 'date',
    ];
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
