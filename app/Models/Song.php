<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Song
 * 
 * @property int $id
 * @property string|null $artist
 * @property string $title
 * @property string|null $lyrics
 * @property string|null $description
 * @property Carbon|null $production_date
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 *
 * @package App\Models
 */
class Song extends Model {
	protected $table = 'songs';

	protected $casts = [
		'production_date' => 'date',
		'created_at'      => 'date',
		'created_by'      => 'int',
		'updated_at'      => 'date',
		'updated_by'      => 'int'
	];

	protected $fillable = [
		'artist',
		'title',
		'lyrics',
		'description',
		'production_date',
		'created_by',
		'updated_by'
	];
	}
