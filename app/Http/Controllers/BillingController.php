<?php

namespace App\Http\Controllers;

use App\Models\BankModel;
use App\Models\DirectorModel;
use App\Models\HeaderModel;
use App\Models\InvoiceModel;
use App\Models\ReceiptModel;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $bills = InvoiceModel::where('is_active', true)->get();

        return view('pages.billing',[
            'bills' => $bills
        ]);
    }

    public function create() {
        $headers = HeaderModel::where('is_active', true)->get();
        $banks = BankModel::where('is_active', true)->get();
        $receipts = ReceiptModel::where('is_active', true)->get();
        $directors = DirectorModel::where('is_active', true)->get();

        return view('pages.billing-create',[
            'headers' => $headers,
            'banks' => $banks,
            'receipts' => $receipts,
            'directors' => $directors
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required',
            'invoice_date' => 'required',
            'config_banks_id' => 'required',
            'config_headers_id' => 'required',
            'recepts_id' => 'required',
            'directors_id' => 'required',
            'descriptions' => 'required',
            'amounts' => 'required',
            'prices' => 'required',
        ]);

        $invoice = InvoiceModel::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'discount' => $request->discount,
            'config_banks_id' => $request->config_banks_id,
            'config_headers_id' => $request->config_headers_id,
            'recepts_id' => $request->recepts_id,
            'directors_id' => $request->directors_id,
            'is_active' => true
        ]);

        $descriptions = $request->descriptions;
        $amounts = $request->amounts;
        $prices = $request->prices;

        for ($i=0; $i < count($descriptions); $i++) {
            $invoice->descriptions()->create([
                'description' => $descriptions[$i],
                'amount' => $amounts[$i],
                'price' => $prices[$i],
                'is_active' => true
            ]);
        }

        return redirect()->route('billing.index')->with('success', 'Billing created successfully.');
    }

    public function pdf($id)
    {
        $bill = InvoiceModel::find($id);

        // generate pdf
        $pdf = \PDF::loadView('pages.billing-pdf', [
            'bill' => $bill
        ]);

        // set paper size
        $pdf->setPaper('A4', 'portrait');

        // show pdf on browser
        return $pdf->stream();
    }
}
