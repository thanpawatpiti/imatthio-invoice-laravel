<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeaderModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'config_headers';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'tax_id',
        'website',
        'email',
        'is_active',
        'logo'
    ];
}
