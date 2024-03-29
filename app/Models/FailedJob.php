<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FailedJob
 * 
 * @property int $id
 * @property string $uuid
 * @property string $connection
 * @property string $queue
 * @property string $payload
 * @property string $exception
 * @property Carbon $failed_at
 *
 * @package App\Models
 */
class FailedJob extends Model {
	protected $table = 'failed_jobs';
	public $timestamps = FALSE;

	protected $casts = [
		'failed_at' => 'date'
	];

	protected $fillable = [
		'uuid',
		'connection',
		'queue',
		'payload',
		'exception',
		'failed_at'
	];
	}
