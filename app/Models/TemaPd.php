<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TemaPd
 * 
 * @property int $id
 * @property string $title
 * @property Carbon $date
 * @property string|null $media
 * @property string|null $links
 * @property string|null $description
 * @property bool $active
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class TemaPd extends Model
{
	protected $table = 'tema_pd';

	protected $casts = [
		'date' => 'date',
		'active' => 'bool',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'title',
		'date',
		'media',
		'links',
		'description',
		'active',
		'created_by',
		'updated_by'
	];
}
