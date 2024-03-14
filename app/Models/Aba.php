<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ABA
 * 
 * @property int $id
 * @property int $user_id
 * @property string $verses
 * @property Carbon $date
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $updated_by
 *
 * @package App\Models
 */

class Aba extends Model
    {
    use HasFactory;
    protected $table = 'aba';

    protected $casts = [ 
        'user_id'    => 'int',
        'date'       => 'date',
        'created_at' => 'date',
        'created_by' => 'int',
        'updated_at' => 'date',
        'updated_by' => 'int'
    ];

    protected $fillable = [ 
        'user_id',
        'date',
        'verses',
        'description',
        'created_by',
        'updated_by'
    ];
    }
