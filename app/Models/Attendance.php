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
 * @property Carbon|null $date
 * @property string|null $description
 * @property bool $active
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 * @property User $user
 * @property Event $event
 *
 * @package App\Models
 */
class Attendance extends Model
	{
	protected $table = 'attendance';

	protected $casts = [ 
		'user_id'    => 'int',
		'event_id'   => 'int',
		'date'       => 'date',
		'active'     => 'bool',
		'created_at' => 'date',
		'created_by' => 'int',
		'updated_at' => 'date',
		'updated_by' => 'int'
	];

	protected $fillable = [ 
		'user_id',
		'event_id',
		'date',
		'description',
		'active',
		'created_by',
		'updated_by'
	];

	public function user ()
		{
		return $this->belongsTo ( User::class);
		}

	public function event ()
		{
		return $this->belongsTo ( Event::class);
		}
	}
