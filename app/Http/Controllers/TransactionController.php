<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Transaction;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    protected $logServices;
    public function __construct(LogServices $logServices)
    {
        $this->logServices = $logServices;
    }
    public function index()
    {
        $user = Auth::user();
        $transactions = $user->transactions()->get();
        return view('mahasiswa.transaksi.index', compact('transactions'));
    }

    public function kurir()
    {
        $transactions = Transaction::with([
            'ijazah',
            'transkrip',
            'akta',
            'user',
            'province',
            'city'
        ])->where('user_id', Auth::user()->id)
        ->where(function ($query) {
            $query->where('status', 'pengiriman')
                  ->orWhere('status', 'selesai');
        })
        ->get();
        return view('mahasiswa.kurir.index', compact('transactions'));
    }

    public function create()
    {
        $user = Auth::user();
        $student = $user->student;
        if(
            !$student->tempat_lahir ||
            !$student->tanggal_lahir ||
            !$student->program_studi ||
            !$student->nomor_ijazah ||
            !$student->no_hp ||
            !$student->province_id ||
            !$student->city_id ||
            !$student->alamat_pengiriman ||
            !$student->kode_pos
        ){
            return redirect()->back()->with('error', 'Silahkan lengkapi biodata terlebih dahulu.');
        }

        $file_ijazah = Document::where('user_id', $user->id)->where('type', 'file_ijazah')->where('is_active', true)->first();
        $file_transkrip = Document::where('user_id', $user->id)->where('type', 'file_transkrip')->where('is_active', true)->first();
        $file_akta = Document::where('user_id', $user->id)->where('type', 'file_akta')->where('is_active', true)->first();

        return view('mahasiswa.transaksi.create', compact('file_ijazah', 'file_transkrip', 'file_akta'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string',
            'no_hp' => 'required|string',
            'province_id' => 'required|string',
            'city_id' => 'required|string',
            'kode_pos' => 'required|string',
            'jumlah_ijazah' => 'required|integer|min:1|max:10',
            'jumlah_transkrip' => 'nullable|integer|min:1|max:10',
            'jumlah_akta' => 'nullable|integer|min:1|max:10',
            // 'shipping_method' => 'required|string',
            'alamat_pengiriman' => 'required|string',
        ]);

        // $shipping_method = $request->shipping_method;

        // $parts = explode('|', $shipping_method);
        // $pengiriman = trim($parts[0]);
        // $harga_pengiriman = (int) trim($parts[1]);

        $user = Auth::user();
        $sarjana = $user->student->sarjana;

        $file_akta = Document::where('user_id', $user->id)
            ->where('type', 'file_akta')
            ->where('is_active', true)
            ->first();

        $biaya_akta = 0;
        $biaya_legalisir = 0;

        // Jika ada akta mengajar, biaya legalisir menjadi 10.000
        if ($file_akta) {
            $biaya_akta = 10000;
        }
        if($sarjana == 'Sarjana'){
            $biaya_legalisir = 5000;
        } elseif ($sarjana == 'Magister' || $sarjana == 'Doktor') {
            $biaya_legalisir = 10000;
        } else {
            $biaya_legalisir = 5000;
        }

        $file_ijazah = Document::where('user_id', $user->id)->where('type', 'file_ijazah')->where('is_active', true)->first();
        $file_transkrip = Document::where('user_id', $user->id)->where('type', 'file_transkrip')->where('is_active', true)->first();
        $file_akta = Document::where('user_id', $user->id)->where('type', 'file_akta')->where('is_active', true)->first();

        $biaya_ijazah = 0;
        $biaya_transkrip = 0;
        $biaya_akta = 0;
        if($file_ijazah){
            $biaya_ijazah = $biaya_legalisir * $request->jumlah_ijazah;
        }
        if($file_transkrip){
            $biaya_transkrip = $biaya_legalisir * $request->jumlah_transkrip;
        }
        if($file_akta){
            $biaya_akta = $biaya_legalisir * $request->jumlah_akta;
        }

        $biaya_legalisir = $biaya_ijazah + $biaya_transkrip + $biaya_akta;
        // $total_pembayaran = $biaya_legalisir + $harga_pengiriman;
        $total_pembayaran = $biaya_legalisir;

        $user->transactions()->create([
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'kode_pos' => $request->kode_pos,
            'status' => 'menunggu acc',

            'file_ijazah' => $file_ijazah ? $file_ijazah->id : null,
            'file_transkrip' => $file_transkrip ? $file_transkrip->id : null,
            'file_akta' => $file_akta ? $file_akta->id : null,

            'jumlah_ijazah' => $request->jumlah_ijazah,
            'jumlah_transkrip' => $request->jumlah_transkrip ? $request->jumlah_transkrip : 0,
            'jumlah_akta' => $request->jumlah_akta ? $request->jumlah_akta : 0,
            // 'pengiriman' => $pengiriman,

            // 'biaya_ongkir' => $harga_pengiriman,
            'biaya_legalisir' => $biaya_legalisir,
            'total_pembayaran' => $total_pembayaran,
            'harga_packing' => 21000,
        ]);

        $this->logServices->createLog(
            'Pengajuan',
            'Pengajuan baru dibuat dengan ID: ' . $user->transactions()->latest()->first()->id,
            $user->id
        );

        return redirect()->route('mahasiswa.transaksi.index');
    }

    public function storeAmbilKampus(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string',
            'no_hp' => 'required|string',

            'jumlah_ijazah' => 'required|integer|min:1|max:10',
            'jumlah_transkrip' => 'nullable|integer|min:1|max:10',
            'jumlah_akta' => 'nullable|integer|min:1|max:10',
        ]);

        $user = Auth::user();

        // Ambil program studi mahasiswa dari tabel student
        $program_studi = $user->student->program_studi ?? '';

        // Cek apakah ada akta mengajar
        $file_akta = Document::where('user_id', $user->id)
            ->where('type', 'file_akta')
            ->where('is_active', true)
            ->first();

        // Jika ada akta mengajar, biaya legalisir menjadi 10.000
        if ($file_akta) {
            $biaya_legalisir = 10000;
        } else {
            // Jika tidak ada akta, biaya tergantung jenjang studi
            if (str_contains($program_studi, 'Sarjana')) {
                $biaya_legalisir = 5000;
            } elseif (str_contains($program_studi, 'Magister') || str_contains($program_studi, 'Doktor')) {
                $biaya_legalisir = 10000;
            } else {
                $biaya_legalisir = 5000; // Default jika tidak sesuai
            }
        }

        // Hitung total biaya legalisir
        $total_biaya_legalisir = $biaya_legalisir * $request->jumlah_legalisir;

        // Ambil dokumen terkait
        $file_ijazah = Document::where('user_id', $user->id)->where('type', 'file_ijazah')->where('is_active', true)->first();
        $file_transkrip_1 = Document::where('user_id', $user->id)->where('type', 'file_transkrip_1')->where('is_active', true)->first();
        $file_transkrip_2 = Document::where('user_id', $user->id)->where('type', 'file_transkrip_2')->where('is_active', true)->first();

        // Simpan transaksi
        $transaction = $user->transactions()->create([
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'status' => 'menunggu acc',
            'file_ijazah' => $file_ijazah ? $file_ijazah->id : null,
            'file_transkrip_1' => $file_transkrip_1 ? $file_transkrip_1->id : null,
            'file_transkrip_2' => $file_transkrip_2 ? $file_transkrip_2->id : null,
            'file_akta' => $file_akta ? $file_akta->id : null,
            'jumlah_pembayaran' => $total_biaya_legalisir,
            'jumlah_legalisir' => $request->jumlah_legalisir,
        ]);

        return redirect()->route('mahasiswa.transaksi.index');
    }



    public function detail($id)
    {
        $transaction = Transaction::find($id);
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

        $this->logServices->createLog(
            'Upload Bukti Pembayaran',
            'Bukti pembayaran diunggah untuk transaksi ID: ' . $transactionId,
            Auth::id()
        );

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

        $this->logServices->createLog(
            'Terima Dokumen',
            'Dokumen legalisir diterima untuk transaksi ID: ' . $id,
            Auth::id()
        );

        return redirect()->route('mahasiswa.transaksi.index')->with('success', 'Dokumen legalisir berhasil diterima.');
    }


}
