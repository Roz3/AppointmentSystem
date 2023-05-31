<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Referral;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'year_level',
        'course_id',
        'department_id',
        'barangay',
        'municipal',
        'province',
        'password',
        'user_type',
        'profile_image',
        'contact'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin()
    {
        if ($this->user_type === 'admin') {
            return $this->hasOne(Admin::class);
        }

        return null;
    }
    
    public function unreadReferralNotifications()
    {
        return $this->unreadNotifications()
                    ->whereHas('sender', function ($query) {
                        $query->where('type', 'instructor');
                    })
                    ->where('type', 'App\Notifications\ReferralNotification')
                    ->get();
    }

    

    public function unreadReferrals()
    {
        return Referral::where('student_id', $this->id)
                        ->whereNull('updated_at')
                        ->get();
    }
    

    public function markReferralAsRead($referralId)
    {
        Referral::where('id', $referralId)
                ->where('counselor_id', $this->id)
                ->update(['counselor_read_at' => now()]);
    }
    
    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'counselor_id');
    }
    
  
}
