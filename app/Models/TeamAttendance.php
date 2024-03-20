<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Team Attendance
 * 
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property Carbon|null $date
 * @property string|null $description
 * @property bool $active
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 * @property User $user
 *
 * @package App\Models
 */

class TeamAttendance extends Model {
    use HasFactory;
    protected $table = 'team_attendances';

    protected $casts = [
        'user_id'       => 'int',
        'team_event_id' => 'int',
        'date'          => 'datetime: H:i',
        'active'        => 'bool',
        'created_at'    => 'datetime',
        'created_by'    => 'int',
        'updated_at'    => 'datetime',
        'updated_by'    => 'int'
    ];

    protected $fillable = [
        'user_id',
        'team_event_id',
        'date',
        'description',
        'active',
        'created_by',
        'updated_by'
    ];

    public function user() {
        return $this->belongsTo(User::class);
        }
    }
