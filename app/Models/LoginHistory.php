<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LoginHistory
 * 
 * @property int $id
 * @property int $user_id
 * @property int $password
 * @property string $status
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 * 
 * @property User $user
 *
 * @package App\Models
 */
class LoginHistory extends Model {
	protected $table = 'login_history';

	protected $casts = [
		'user_id'    => 'int',
		'password'   => 'int',
		'created_at' => 'date',
		'created_by' => 'int',
		'updated_at' => 'date',
		'updated_by' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'user_id',
		'password',
		'status',
		'description',
		'created_by',
		'updated_by'
	];

	public function user() {
		return $this->belongsTo(User::class);
		}
	}
