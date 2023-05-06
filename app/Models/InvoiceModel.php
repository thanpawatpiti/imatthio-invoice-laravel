<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoices';

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'discount',
        'config_banks_id',
        'config_headers_id',
        'recepts_id',
        'directors_id',
        'is_active'
    ];

    protected $dates = [
        'invoice_date',
    ];

    protected $cats = [
        'is_active' => 'boolean',
        'invoice_date' => 'date'
    ];

    public function descriptions()
    {
        return $this->hasMany(InvoiceDescriptionModel::class, 'invoices_id', 'id');
    }

    public function banks()
    {
        return $this->belongsTo(BankModel::class, 'config_banks_id', 'id');
    }

    public function headers()
    {
        return $this->belongsTo(HeaderModel::class, 'config_headers_id', 'id');
    }

    public function receipts()
    {
        return $this->belongsTo(ReceiptModel::class, 'recepts_id', 'id');
    }
}
