<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Team Event
 * 
 * @property int $id
 * @property string $title
 * @property Carbon $date
 * @property string|null $description
 * @property bool $active
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 * 
 * @package App\Models
 */

class TeamEvents extends Model {
    use HasFactory;

    protected $table = 'team_events';

    protected $casts = [
        'date'       => 'date',
        'active'     => 'bool',
        'created_at' => 'date',
        'created_by' => 'int',
        'updated_at' => 'date',
        'updated_by' => 'int'
    ];

    protected $fillable = [
        'title',
        'date',
        'description',
        'active',
        'created_by',
        'updated_by'
    ];
    }
