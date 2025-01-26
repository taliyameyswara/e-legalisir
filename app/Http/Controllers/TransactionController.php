<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // ketika create transaction
    //   $table->foreignId('file_ijazah')->nullable()->constrained('documents')->cascadeOnDelete();
    // $table->foreignId('file_transkrip_1')->nullable()->constrained('documents')->cascadeOnDelete();
    // $table->foreignId('file_transkrip_2')->nullable()->constrained('documents')->cascadeOnDelete();
    // 3 data diatas diambil dari tabel document yang memiliki user_id yang sama dengan user_id yang sedang login
    // type nya sesuai nama atribut dan is_active nya true

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

        return view('mahasiswa.transaksi.create', compact('file_ijazah', 'file_transkrip_1', 'file_transkrip_2'));
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
            'kurir' => 'required|string',
        ]);

        $user = Auth::user();
        $file_ijazah = Document::where('user_id', $user->id)->where('type', 'file_ijazah')->where('is_active', true)->first();
        $file_transkrip_1 = Document::where('user_id', $user->id)->where('type', 'file_transkrip_1')->where('is_active', true)->first();
        $file_transkrip_2 = Document::where('user_id', $user->id)->where('type', 'file_transkrip_2')->where('is_active', true)->first();

        $biaya_legalisir = 15000;
        $biaya_ongkir = 5000;
        $jumlah_pembayaran = $biaya_legalisir + $biaya_ongkir;

        $transaction = $user->transactions()->create([
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'kode_pos' => $request->kode_pos,
            'kurir' => $request->kurir,
            'file_ijazah' => $file_ijazah ? $file_ijazah->id : null,
            'file_transkrip_1' => $file_transkrip_1 ? $file_transkrip_1->id : null,
            'file_transkrip_2' => $file_transkrip_2 ? $file_transkrip_2->id : null,
            'jumlah_pembayaran' => $jumlah_pembayaran,
        ]);

        return redirect()->route('mahasiswa.transaksi.index');
    }

    public function detail($id)
    {
        $transaction = Transaction::find($id);
        $transaction->file_ijazah = Document::find($transaction->file_ijazah);
        $transaction->file_transkrip_1 = Document::find($transaction->file_transkrip_1);
        $transaction->file_transkrip_2 = Document::find($transaction->file_transkrip_2);
        return view('mahasiswa.transaksi.detail', compact('transaction'));
    }

    // TransactionController.php

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
}
