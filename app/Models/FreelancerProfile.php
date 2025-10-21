<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerProfile extends Model {
    protected $fillable = [
        'user_id','phone','dob','gender','location','category','subcategory','uploads','experience','test_given','is_paid'
    ];

    protected $casts = [
        'uploads' => 'array',
        'test_given' => 'boolean',
        'is_paid' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(\App\Models\User::class);
    }
}
