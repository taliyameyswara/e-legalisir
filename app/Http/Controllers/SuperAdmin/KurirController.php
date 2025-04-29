<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KurirController extends Controller
{
    public function index(){
        // transaction yang status nya pengiriman / selesai
        $transactions = \App\Models\Transaction::with([
            'ijazah',
            'transkrip',
            'akta',
            'user',
            'province',
            'city'
        ])->where('status', 'pengiriman')->orWhere('status', 'selesai')->get();

        return view('superadmin.kurir.index', compact('transactions'));
    }
}
