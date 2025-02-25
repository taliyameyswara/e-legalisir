<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = $user->transactions()->get();
        return view('mahasiswa.transaksi.index', compact('transactions'));
    }

    public function create()
    {
        $user = Auth::user();
        $file_ijazah = Document::where('user_id', $user->id)->where('type', 'file_ijazah')->where('is_active', true)->first();
        $file_transkrip_1 = Document::where('user_id', $user->id)->where('type', 'file_transkrip_1')->where('is_active', true)->first();
        $file_transkrip_2 = Document::where('user_id', $user->id)->where('type', 'file_transkrip_2')->where('is_active', true)->first();
        $akta_mengajar = Document::where('user_id', $user->id)->where('type', 'akta_mengajar')->where('is_active', true)->first();

        return view('mahasiswa.transaksi.create', compact('file_ijazah', 'file_transkrip_1', 'file_transkrip_2', 'akta_mengajar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string',
            'no_hp' => 'required|string',
            'province_id' => 'required|string',
            'city_id' => 'required|string',
            'alamat_pengiriman' => 'required|string',
            'kode_pos' => 'required|string',
            // 'kurir' => 'required|string',
            'jumlah_legalisir' => 'required|integer|min:1|max:10',
        ]);

        // $kurirData = explode('|', $request->kurir);
        // $layanan = $kurirData[0]; // "REGLayanan Reguler"
        // $harga = $kurirData[1]; // "20000"

        // dd($layanan, $harga);

        $user = Auth::user();
        $file_ijazah = Document::where('user_id', $user->id)->where('type', 'file_ijazah')->where('is_active', true)->first();
        $file_transkrip_1 = Document::where('user_id', $user->id)->where('type', 'file_transkrip_1')->where('is_active', true)->first();
        $file_transkrip_2 = Document::where('user_id', $user->id)->where('type', 'file_transkrip_2')->where('is_active', true)->first();
        $akta_mengajar = Document::where('user_id', $user->id)->where('type', 'akta_mengajar')->where('is_active', true)->first();

        $biaya_legalisir = 5000 * $request->jumlah_legalisir;
        // $biaya_ongkir = (int) $harga;
        $jumlah_pembayaran = $biaya_legalisir;

        $transaction = $user->transactions()->create([
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'kode_pos' => $request->kode_pos,
            'status' => 'menunggu acc',
            'file_ijazah' => $file_ijazah ? $file_ijazah->id : null,
            'file_transkrip_1' => $file_transkrip_1 ? $file_transkrip_1->id : null,
            'file_transkrip_2' => $file_transkrip_2 ? $file_transkrip_2->id : null,
            'akta_mengajar' => $akta_mengajar ? $akta_mengajar->id : null,
            'jumlah_pembayaran' => $jumlah_pembayaran,
            'jumlah_legalisir' => $request->jumlah_legalisir,
        ]);

        return redirect()->route('mahasiswa.transaksi.index');
    }

    public function detail($id)
    {
        $transaction = Transaction::find($id);
        $transaction->file_ijazah = Document::find($transaction->file_ijazah);
        $transaction->file_transkrip_1 = Document::find($transaction->file_transkrip_1);
        $transaction->file_transkrip_2 = Document::find($transaction->file_transkrip_2);
        $transaction->akta_mengajar = Document::find($transaction->akta_mengajar);
        return view('mahasiswa.transaksi.detail', compact('transaction'));
    }

    public function uploadPaymentProof(Request $request, $transactionId)
    {

        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpeg,jpg,png|max:10240',
        ]);


        $transaction = Transaction::findOrFail($transactionId);
        $path = $request->file('bukti_pembayaran')->store('payment_proofs', 'public');

        $transaction->update([
            'bukti_pembayaran' => $path,
            'status' => 'proses legalisir',
        ]);

        return redirect()->route('mahasiswa.transaksi.detail', $transactionId)
            ->with('success', 'Bukti pembayaran berhasil diunggah.');
    }



    public function accept($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->status !== 'pengiriman') {
            return redirect()->route('mahasiswa.transaksi.index')->with('error', 'Transaksi tidak dapat diterima.');
        }

        $transaction->update([
            'status' => 'selesai',
        ]);

        return redirect()->route('mahasiswa.transaksi.index')->with('success', 'Dokumen legalisir berhasil diterima.');
    }
}
