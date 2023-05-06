<?php

namespace App\Http\Controllers;

use App\Models\BankModel;
use App\Models\DirectorModel;
use App\Models\HeaderModel;
use App\Models\ReceiptModel;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $headers = HeaderModel::all();
        $banks = BankModel::all();
        $receipts = ReceiptModel::all();
        $directors = DirectorModel::all();

        return view('pages.setting', [
            'headers' => $headers,
            'banks' => $banks,
            'receipts' => $receipts,
            'directors' => $directors
        ]);
    }

    public function create($type)
    {
        if ($type == 'headers') {
            return view('pages.setting-headers');
        } elseif ($type == 'banks') {
            return view('pages.setting-banks');
        } elseif ($type == 'receipts') {
            return view('pages.setting-receipts');
        } elseif ($type == 'directors') {
            return view('pages.setting-directors');
        } else {
            return redirect()->route('setting.index')->withErrors(['msg' => 'Type not found']);
        }
    }

    public function store(Request $request)
    {
        $type = $request->type;
        if ($type == 'header') {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'tax_id' => 'required'
            ]);

            // upload image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '.' . $image->extension();
                $image->move(public_path('images'), $image_name);
            } else {
                $image_name = '';
            }

            $data = [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'tax_id' => $request->tax_id,
                'is_active' => 1,
                'logo' => $image_name,
                'email' => $request->email,
                'website' => $request->website,
            ];

            $setting = HeaderModel::create($data);

            if ($setting) {
                return redirect()->route('setting.index')->with(['success' => 'Save successfully']);
            } else {
                return redirect()->route('setting.index')->withErrors(['msg' => 'Save failed']);
            }
        } elseif ($type == 'bank') {
            $request->validate([
                'bank' => 'required',
                'branch' => 'required',
                'bank_number' => 'required',
                'bank_name' => 'required'
            ]);

            $data = [
                'bank' => $request->bank,
                'branch' => $request->branch,
                'bank_number' => $request->bank_number,
                'bank_name' => $request->bank_name,
                'is_active' => 1
            ];

            $setting = BankModel::create($data);

            if ($setting) {
                return redirect()->route('setting.index')->with(['success' => 'Save successfully']);
            } else {
                return redirect()->route('setting.index')->withErrors(['msg' => 'Save failed']);
            }
        } elseif ($type == 'receipt') {
            $request->validate([
                'name' => 'required',
                'address' => 'required',
                'tax_id' => 'required'
            ]);

            $data = [
                'name' => $request->name,
                'address' => $request->address,
                'tax_id' => $request->tax_id,
                'is_active' => 1
            ];

            $setting = ReceiptModel::create($data);

            if ($setting) {
                return redirect()->route('setting.index')->with(['success' => 'Save successfully']);
            } else {
                return redirect()->route('setting.index')->withErrors(['msg' => 'Save failed']);
            }
        } elseif ($type == 'director') {
            $request->validate([
                'name' => 'required',
                'surname' => 'required',
                'position' => 'required'
            ]);

            $data = [
                'name' => $request->name,
                'surname' => $request->surname,
                'position' => $request->position,
                'is_active' => 1
            ];

            $setting = DirectorModel::create($data);

            if ($setting) {
                return redirect()->route('setting.index')->with(['success' => 'Save successfully']);
            } else {
                return redirect()->route('setting.index')->withErrors(['msg' => 'Save failed']);
            }
        } else {
            return redirect()->route('setting.index')->withErrors(['msg' => 'Type not found']);
        }
    }
}
