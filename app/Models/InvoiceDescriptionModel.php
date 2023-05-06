<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDescriptionModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoice_descriptions';

    protected $fillable = [
        'invoices_id',
        'description',
        'amount',
        'price',
        'plant',
        'is_active'
    ];
}
