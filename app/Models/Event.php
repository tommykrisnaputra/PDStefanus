<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * 
 * @property int $id
 * @property string $name
 * @property Carbon $date
 * @property string|null $media
 * @property string|null $links
 * @property string|null $description
 * @property bool $active
 * @property int|null $order_number
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 * 
 * @property Collection|Attendance[] $attendances
 *
 * @package App\Models
 */
class Event extends Model
{
	protected $table = 'events';

	protected $casts = [
		'date' => 'date',
		'active' => 'bool',
		'order_number' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'name',
		'date',
		'media',
		'links',
		'description',
		'active',
		'order_number',
		'created_by',
		'updated_by'
	];

	public function attendances()
	{
		return $this->hasMany(Attendance::class);
	}
}
