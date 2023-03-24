<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property bool $active
 * @property string|null $description
 * @property Carbon|null $begin_date
 * @property Carbon|null $end_date
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';

	protected $casts = [
		'active' => 'bool',
		'begin_date' => 'date',
		'end_date' => 'date',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'name',
		'image',
		'active',
		'description',
		'begin_date',
		'end_date',
		'created_by',
		'updated_by'
	];

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
