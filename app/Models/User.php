<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Role constants
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_DRIVER = 'driver';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'additional_contact',
        'profile_photo_path',
        'role',
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
        'password' => 'hashed',
    ];

    /**
     * Get the URL of the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }
        
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Check if the user is a driver.
     *
     * @return bool
     */
    public function isDriver()
    {
        return $this->role === self::ROLE_DRIVER;
    }

    /**
     * Get the police verification for the user.
     */
    public function policeVerification()
    {
        return $this->hasOne(PoliceVerification::class);
    }

    /**
     * Get the driver license for the user.
     */
    public function driverLicense()
    {
        return $this->hasOne(DriverLicense::class);
    }

    /**
     * Get the Aadhaar card for the user.
     */
    public function aadhaarCard()
    {
        return $this->hasOne(AadhaarCard::class);
    }

    /**
     * Get the pollution verification for the user.
     */
    public function pollutionVerification()
    {
        return $this->hasOne(PollutionVerification::class);
    }

    /**
     * Get the insurance verification for the user.
     */
    public function insuranceVerification()
    {
        return $this->hasOne(InsuranceVerification::class);
    }

    /**
     * Get the vehicle registration for the user.
     */
    public function vehicleRegistration()
    {
        return $this->hasOne(VehicleRegistration::class);
    }
    // User.php
public function bankDetail() { return $this->hasOne(UserBankDetail::class); }
public function driverVehicle() { return $this->hasOne(DriverVehicle::class); }

}
