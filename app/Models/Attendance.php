<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Attendance
 * 
 * @property int $id
 * @property int $user_id
 * @property int $event_id
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 * 
 * @property User $user
 * @property Event $event
 *
 * @package App\Models
 */
class Attendance extends Model
{
	protected $table = 'attendance';

	protected $casts = [
		'user_id' => 'int',
		'event_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'user_id',
		'event_id',
		'description',
		'created_by',
		'updated_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}
