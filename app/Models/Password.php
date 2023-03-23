<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Password
 * 
 * @property int $id
 * @property int|null $user_id
 * @property string $password
 * @property string|null $password_question
 * @property string|null $password_answer
 * @property string $active
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $udpated_by
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class Password extends Model
{
	protected $table = 'password';

	protected $casts = [
		'user_id' => 'int',
		'created_by' => 'int',
		'udpated_by' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'user_id',
		'password',
		'password_question',
		'password_answer',
		'active',
		'created_by',
		'udpated_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
