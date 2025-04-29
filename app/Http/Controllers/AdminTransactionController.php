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
    public function acc($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'status' => 'menunggu pembayaran',
        ]);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil acc');
    }

    public function approve(Request $request, $id)
    {

        $request->validate([
            'nomor_pengiriman' => 'required|string|max:20',
            'biaya_ongkir' => 'required|integer',
        ]);

        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'proses legalisir') {
            return redirect()->route('superadmin.transaksi.index')->with('error', 'Transaksi tidak dapat disetujui.');
        }

        $transaction->update([
            'status' => 'pengiriman',
            'nomor_pengiriman' => $request->nomor_pengiriman,
            'biaya_ongkir' => $request->biaya_ongkir,
            'pengiriman' => 'NCS'
        ]);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil disetujui dengan nomor pengiriman: ' . $request->nomor_pengiriman);
    }

    public function approveAmbilKampus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'proses legalisir') {
            return redirect()->route('admin.transaksi.index')->with('error', 'Transaksi tidak dapat disetujui.');
        }

        $transaction->update([
            'status' => 'pengiriman',
        ]);

        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil disetujui dengan nomor pengiriman: ' . $request->nomor_pengiriman);
    }

    public function tolak($id, Request $request){

        $request->validate([
            'alasan_tolak' => 'required|string|max:255',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'status' => 'ditolak',
            'alasan_tolak' => $request->alasan_tolak,
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil ditolak.');
    }
}
