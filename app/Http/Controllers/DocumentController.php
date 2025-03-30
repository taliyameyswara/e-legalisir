<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $file_ijazah = Document::where('user_id', $user->id)->where('type', 'file_ijazah')->where('is_active', true)->first();
        $file_transkrip = Document::where('user_id', $user->id)->where('type', 'file_transkrip')->where('is_active', true)->first();
        $file_akta = Document::where('user_id', $user->id)->where('type', 'file_akta')->where('is_active', true)->first();
        return view('mahasiswa.legalisir.index', compact('user', 'file_ijazah', 'file_transkrip', 'file_akta'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_ijazah' => 'required|mimes:pdf|max:1024', // Tidak wajib jika hanya ingin mengganti sebagian
            'file_transkrip' => 'nullable|mimes:pdf|max:1024',
            'file_akta' => 'nullable|mimes:pdf|max:1024',
            'input_ijazah' => 'required|integer',
            'input_transkrip' => 'nullable|integer',
            'input_akta' => 'nullable|integer',
        ], [
            'file_ijazah.mimes' => 'File Ijazah harus dalam format pdf.',
            'file_transkrip.mimes' => 'File Transkrip Nilai harus dalam format pdf.',
            'file_akta.mimes' => 'File Akta Mengajar harus dalam format pdf.',
            'file_ijazah.max' => 'Ukuran File Ijazah tidak boleh lebih dari 1 MB.',
            'file_transkrip.max' => 'Ukuran File Transkrip Nilai tidak boleh lebih dari 1 MB.',
            'file_akta.max' => 'Ukuran File Akta Mengajar tidak boleh lebih dari 1 MB.',
            'input_ijazah.required' => 'Jumlah Ijazah tidak boleh kosong.',
            'input_transkrip.required' => 'Jumlah Transkrip Nilai tidak boleh kosong.',
            'input_akta.required' => 'Jumlah Akta Mengajar tidak boleh kosong.',
        ]);

        // Perbarui hanya file yang diunggah
        if ($request->hasFile('file_ijazah')) {
            Document::where('user_id', Auth::id())
                ->where('type', 'file_ijazah')
                ->update(['is_active' => false]);
            $ijazah = Document::create([
                'user_id' => Auth::id(),
                'file' => 'storage/' . $request->file('file_ijazah')->store('documents', 'public'),
                'file_name' => $request->file('file_ijazah')->getClientOriginalName(),
                'type' => 'file_ijazah',
                'jumlah_legalisir' => $request->input('input_ijazah'),
                'is_active' => true,
            ]);

            $ijazahThumbnail = new \Spatie\PdfToImage\Pdf($ijazah->file);
            $ijazahThumbnail->setOutputFormat('png')
                ->saveImage('storage/' . $ijazah->id . '.jpg');

            $ijazah->thumbnail = 'storage/' . $ijazah->id . '.jpg';
            $ijazah->save();

            // $document->file_ijazah = $request->file('file_ijazah')->store('documents', 'public');
        }

        if ($request->hasFile('file_transkrip')) {
            Document::where('user_id', Auth::id())
                ->where('type', 'file_transkrip')
                ->update(['is_active' => false]);
            $transkrip =  Document::create([
                'user_id' => Auth::id(),
                'file' => 'storage/' . $request->file('file_transkrip')->store('documents', 'public'),
                'file_name' => $request->file('file_transkrip')->getClientOriginalName(),
                'type' => 'file_transkrip',
                'jumlah_legalisir' => $request->input('input_transkrip'),
                'is_active' => true,
            ]);

            $transkripThumbnail = new \Spatie\PdfToImage\Pdf($transkrip->file);
            $transkripThumbnail->setOutputFormat('png')
                ->saveImage('storage/' . $transkrip->id . '.jpg');

            $transkrip->thumbnail = 'storage/' . $transkrip->id . '.jpg';
            $transkrip->save();
        }

        if ($request->hasFile('file_akta')) {
            Document::where('user_id', Auth::id())
                ->where('type', 'file_akta')
                ->update(['is_active' => false]);

            $akta =   Document::create([
                'user_id' => Auth::id(),
                'file' => 'storage/' . $request->file('file_akta')->store('documents', 'public'),
                'file_name' => $request->file('file_akta')->getClientOriginalName(),
                'type' => 'file_akta',
                'jumlah_legalisir' => $request->input('input_akta'),
                'is_active' => true,
            ]);

            $aktaThumbnail = new \Spatie\PdfToImage\Pdf($akta->file);
            $aktaThumbnail->setOutputFormat('png')
                ->saveImage('storage/' . $akta->id . '.jpg');

            $akta->thumbnail = 'storage/' . $akta->id . '.jpg';
            $akta->save();
        }

        // Redirect ke halaman riwayat dengan pesan sukses
        return redirect()->route('mahasiswa.legalisir.index')->with('success', 'Dokumen berhasil diunggah atau diperbarui!');
    }
}
