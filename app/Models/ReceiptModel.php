<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiptModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'recepts';

    protected $fillable = [
        'name',
        'address',
        'tax_id',
        'is_active'
    ];
}
