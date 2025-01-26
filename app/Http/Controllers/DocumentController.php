<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $document = Document::where('user_id', $user->id)->first();
        return view('mahasiswa.legalisir.index', compact('user', 'document'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'file_ijazah' => 'nullable|mimes:jpg,jpeg,png|max:1024', // Tidak wajib jika hanya ingin mengganti sebagian
            'file_transkrip_1' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            'file_transkrip_2' => 'nullable|mimes:jpg,jpeg,png|max:1024',
        ], [
            'file_ijazah.mimes' => 'File Ijazah harus dalam format jpg, jpeg, atau png.',
            'file_transkrip_1.mimes' => 'File Transkrip Nilai harus dalam format jpg, jpeg, atau png.',
            'file_transkrip_2.mimes' => 'File Transkrip Nilai opsional harus dalam format jpg, jpeg, atau png.',
            'file_ijazah.max' => 'Ukuran File Ijazah tidak boleh lebih dari 1 MB.',
            'file_transkrip_1.max' => 'Ukuran File Transkrip Nilai tidak boleh lebih dari 1 MB.',
            'file_transkrip_2.max' => 'Ukuran File Transkrip Nilai opsional tidak boleh lebih dari 1 MB.',
        ]);

        // Ambil atau buat ulang record dokumen
        $document = Document::updateOrCreate(
            ['user_id' => Auth::id()],
            ['status' => 'menunggu pembayaran']
        );

        // Perbarui hanya file yang diunggah
        if ($request->hasFile('file_ijazah')) {
            if ($document->file_ijazah) {
                Storage::disk('public')->delete($document->file_ijazah); // Hapus file lama
            }
            $document->file_ijazah = $request->file('file_ijazah')->store('documents', 'public');
        }

        if ($request->hasFile('file_transkrip_1')) {
            if ($document->file_transkrip_1) {
                Storage::disk('public')->delete($document->file_transkrip_1); // Hapus file lama
            }
            $document->file_transkrip_1 = $request->file('file_transkrip_1')->store('documents', 'public');
        }

        if ($request->hasFile('file_transkrip_2')) {
            if ($document->file_transkrip_2) {
                Storage::disk('public')->delete($document->file_transkrip_2); // Hapus file lama
            }
            $document->file_transkrip_2 = $request->file('file_transkrip_2')->store('documents', 'public');
        }

        // Simpan perubahan
        $document->save();

        // Redirect ke halaman riwayat dengan pesan sukses
        return redirect()->route('mahasiswa.legalisir.index')->with('success', 'Dokumen berhasil diunggah atau diperbarui!');
    }
}
