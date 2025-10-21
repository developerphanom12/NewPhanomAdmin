<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBankDetail extends Model
{
    protected $fillable = [
        'user_id',
        'bank_name',
        'branch_name',
        'holder_name',
        'account_number',
        'ifsc_code',
    ];

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
