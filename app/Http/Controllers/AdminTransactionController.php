<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index()
    {

        $transactions = Transaction::all();
        return view('admin.transaksi.index', compact('transactions'));
    }

    public function detail($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('admin.transaksi.detail', compact('transaction'));
    }

    public function approve(Request $request, $id)
    {

        $request->validate([
            'nomor_pengiriman' => 'required|string|max:20',
        ]);

        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'proses legalisir') {
            return redirect()->route('admin.transaksi.index')->with('error', 'Transaksi tidak dapat disetujui.');
        }

        $transaction->update([
            'status' => 'pengiriman',
            'nomor_pengiriman' => $request->nomor_pengiriman,
        ]);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil disetujui dengan nomor pengiriman: ' . $request->nomor_pengiriman);
    }
}
