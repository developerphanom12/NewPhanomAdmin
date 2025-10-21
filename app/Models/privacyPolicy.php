<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class privacyPolicy extends Model
{
    use HasFactory;
    protected $table = 'privacyPolicy';
    protected $fillable = ['key', 'value'];
}
