<?php

namespace App\Models;

use App\Factory\Project\ProjectDynamicFactory;
use App\Factory\Project\ProjectFactory;
use App\Imports\ImportProject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $guarded = false;
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

    protected static function updateOrCreate(ProjectFactory|ProjectDynamicFactory $factory): Project
    {
        return parent::query()->updateOrCreate([
            'type_id' => $factory->getValues()['type_id'],
            'title' => $factory->getValues()['title'],
        ], $factory->getValues());
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'project_id', 'id');
    }
}
