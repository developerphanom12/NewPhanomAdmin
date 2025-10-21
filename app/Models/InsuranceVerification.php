<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuranceVerification extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'insurance_number',
        'front_image_path',
        'status', // pending, approved, rejected
        'remarks',
    ];

    /**
     * Get the URL of the front image.
     *
     * @return string|null
     */
    public function getFrontImageUrlAttribute()
    {
        if ($this->front_image_path) {
            return asset('storage/' . $this->front_image_path);
        }
        
        return null;
    }

    /**
     * Get the user that the insurance verification belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 