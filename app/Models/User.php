<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    const ACTIVE_STATUS = 1;
    const BLOCK_STATUS = 0;

    const STATUSES = [1 => 'active', 0 => 'blocked'];
    
    const USER_TYPE = 'user';
    const ADMIN_TYPE = 'admin';
    const BENEFACTOR_TYPE = 'benefactor';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'status',
        'image',
        'phone_number',
        'interesting_type_id',
        'additional_type',
        'organisation_description',
        'date_of_birth',
        'age',
        'api_token',
        'gender',
        'country_id',
        'unique_id',
        'last_name',
        'cover_image_name',
        'cover_image_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'integer',
        'date_of_birth' => 'date'
    ];

    public function receivesBroadcastNotificationsOn()
    {
        return 'user_notifications.'.$this->id;
    }

    public function interesting_type()
    {
        return $this->belongsTo(InterestingType::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function appeals()
    {
        return $this->hasMany(Appeal::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'from', 'unique_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function subscribtions()
    {
        return $this->hasMany(Subscribtion::class, 'subscriber_id', 'unique_id');
    }

    public function subscribers()
    {
        return $this->hasMany(Subscribtion::class, 'user_id', 'unique_id');
    }

    public function subscribed($user_id)
    {
        return (bool)$this->subscribtions()->where('user_id', $user_id)->count();
    }

    public function chat_blocks()
    {
        return $this->hasMany(ChatBlock::class, 'blocker_id', 'unique_id');
    }

    public function has_blocked($unique_id)
    {
        return (bool)$this->chat_blocks()->where('blocker_id', $this->unique_id)
                                    ->where('user_id', $unique_id)->count();
    }

    public function isAdmin():bool
    {
        return $this->type === "admin";
    }
}
