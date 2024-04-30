<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'image' => 'string',
            'role_id' => 'integer'
        ];
    }

    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id')->withTrashed();
    }

    protected function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    protected function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    /**
     * API STARTS HERE
     */
    public function login($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'min: 8',
                'max: 100'
            ],
            'password' => [
                'required',
                'string',
                'min: 8',
                'max: 100'
            ]
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return (object)['status' => false, 'message' => $errors->first(), 'errors' => $errors];
        }
        $login = $request->validate([
            'email' => [
                'required',
                'email',
                'min: 8',
                'max: 100'
            ],
            'password' => [
                'required',
                'string',
                'min: 8',
                'max: 100'
            ]
        ]);
        if (!Auth::attempt($login)) {
            return (object)['status' => false, 'message' => 'Invalid login credentials.', 'errors' => ['error' => 'Invalid login credentials.']];
        }
        $user = Auth::user();
        if (!$user) {
            return (object)['status' => false, 'message' => 'Invalid login credentials.', 'errors' => ['error' => 'Invalid login credentials.']];
        }
        $user = User::find(Auth::user()->id);
        return (object)['status' => true, 'message' => 'Welcome, ' . $user->name . '!', 'data' => $user];
    }
}
