<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'config_banks';

    protected $fillable = [
        'bank',
        'branch',
        'bank_number',
        'bank_name',
        'is_active'
    ];
}
