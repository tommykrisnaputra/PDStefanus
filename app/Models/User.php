<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;
use Carbon\CarbonPeriod;

/**
 * Class User
 *
 * @property int $id
 * @property int|null $role_id
 * @property string $full_name
 * @property Carbon $birthdate
 * @property string|null $address
 * @property string|null $paroki
 * @property string|null $social_instagram
 * @property string|null $social_tiktok
 * @property string $phone
 * @property string|null $image
 * @property string $email
 * @property string|null $description
 * @property string|null $gender
 * @property Carbon $first_attendance
 * @property Carbon|null $last_attendance
 * @property float|null $total_attendance
 * @property float|null $attendance_percentage
 * @property string $password
 * @property string $active
 * @property string $remember_token
 * @property Carbon|null $created_at
 * @property int|null $created_by
 * @property Carbon|null $updated_at
 * @property int|null $udpated_by
 *
 * @property Role|null $role
 * @property Collection|Attendance[] $attendances
 * @property Collection|LoginHistory[] $login_histories
 * @property Collection|Password[] $passwords
 *
 * @package App\Models
 */
class User extends Authenticatable {
    use Notifiable;

    protected $table = 'users';

    protected $casts = [
        'role_id'               => 'int',
        'birthdate'             => 'date',
        'first_attendance'      => 'date',
        'last_attendance'       => 'date',
        'total_attendance'      => 'float',
        'attendance_percentage' => 'float',
        'created_at'            => 'date',
        'created_by'            => 'int',
        'updated_at'            => 'date',
        'updated_by'            => 'int'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $fillable = ['role_id', 'full_name', 'birthdate', 'address', 'wilayah', 'paroki', 'social_instagram', 'social_tiktok', 'phone', 'image', 'email', 'description', 'gender', 'first_attendance', 'last_attendance', 'total_attendance', 'attendance_percentage', 'password', 'active', 'remember_token', 'created_by', 'udpated_by'];

    /**
     * Always encrypt the password when it is updated.
     *
     * @param $value
     */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
        return;
        }

    public function role() {
        return $this->belongsToMany(Role::class);
        }

    public function isAdmin() {
        if (auth()->user()->role_id == 2) {
            return TRUE;
            } else {
            return FALSE;
            }
        }
    public function isTeam() {
        if (auth()->user()->role_id == 2 || auth()->user()->role_id == 3) {
            return TRUE;
            } else {
            return FALSE;
            }
        }
    public function isMember() {
        if (auth()->user()->role_id == 1) {
            return TRUE;
            } else {
            return FALSE;
            }
        }

    public function hasNotification() {
        $user = auth()->user()
            ->unreadNotifications;

        if (count($user) > 0 && auth()->user()->role_id == 2) {
            return TRUE;
            } else {
            return FALSE;
            }
        }

    public function attendances() {
        return $this->hasMany(Attendance::class);
        }

    public function login_histories() {
        return $this->hasMany(LoginHistory::class);
        }

    public function passwords() {
        return $this->hasMany(Password::class);
        }

    public function scopeBirthdayBetween($query, $dayBegin, $dayEnd, $monthBegin, $monthEnd) {
        $currentYear = date('Y');

        $period = CarbonPeriod::create("$currentYear-$monthBegin-$dayBegin", "$currentYear-$monthEnd-$dayEnd");

        foreach ($period as $key => $date) {
            $queryFn = function ($query) use ($date) {
                $query->whereMonth('birthdate', '=', $date->format('m'))->whereDay('birthdate', '=', $date->format('d'));
                };

            if ($key === 0) {
                $queryFn($query);
                } else {
                $query->orWhere(function ($q) use ($queryFn) {
                    $queryFn($q);
                    });
                }
            }

        return $query;
        }
    }