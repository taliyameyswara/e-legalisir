<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Student;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    protected $logServices;
    public function __construct(LogServices $logServices)
    {
        $this->logServices = $logServices;
    }
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
            'file_ijazah' => 'nullable|mimes:pdf|max:1024', // Tidak wajib jika hanya ingin mengganti sebagian
            'file_transkrip' => 'nullable|mimes:pdf|max:1024',
            'file_akta' => 'nullable|mimes:pdf|max:1024',
            'input_ijazah' => 'nullable|integer|max:10',
            'input_transkrip' => 'nullable|integer|max:10',
            'input_akta' => 'nullable|integer|max:10',
        ], [
            'file_ijazah.mimes' => 'File Ijazah harus dalam format pdf.',
            'file_transkrip.mimes' => 'File Transkrip Nilai harus dalam format pdf.',
            'file_akta.mimes' => 'File Akta Mengajar harus dalam format pdf.',
            'file_ijazah.max' => 'Ukuran File Ijazah tidak boleh lebih dari 1 MB.',
            'file_transkrip.max' => 'Ukuran File Transkrip Nilai tidak boleh lebih dari 1 MB.',
            'file_akta.max' => 'Ukuran File Akta Mengajar tidak boleh lebih dari 1 MB.',
            'input_ijazah.max' => 'Jumlah legalisir Ijazah tidak boleh lebih dari 10.',
            'input_transkrip.max' => 'Jumlah legalisir Transkrip Nilai tidak boleh lebih dari 10.',
            'input_akta.max' => 'Jumlah legalisir Akta Mengajar tidak boleh lebih dari 10.',

        ]);

        // Perbarui hanya file yang diunggah
        if ($request->hasFile('file_ijazah')) {
            Document::where('user_id', Auth::id())
                ->where('type', 'file_ijazah')
                ->update(['is_active' => false]);
            Document::create([
                'user_id' => Auth::id(),
                'file' => 'storage/' . $request->file('file_ijazah')->store('documents', 'public'),
                'file_name' => $request->file('file_ijazah')->getClientOriginalName(),
                'type' => 'file_ijazah',
                'jumlah' => $request->input('input_ijazah'),
                'is_active' => true,
            ]);
        }

        if (!$request->hasFile('file_ijazah') && $request->input('input_ijazah')) {
            Document::where('user_id', Auth::id())
                ->where('type', 'file_ijazah')
                ->where('is_active', true)
                ->update(['jumlah' => $request->input('input_ijazah')]);
        }

        if ($request->hasFile('file_transkrip')) {
            Document::where('user_id', Auth::id())
                ->where('type', 'file_transkrip')
                ->update(['is_active' => false]);
            Document::create([
                'user_id' => Auth::id(),
                'file' => 'storage/' . $request->file('file_transkrip')->store('documents', 'public'),
                'file_name' => $request->file('file_transkrip')->getClientOriginalName(),
                'type' => 'file_transkrip',
                'jumlah' => $request->input('input_transkrip'),
                'is_active' => true,
            ]);
        }

        if (!$request->hasFile('file_transkrip') && $request->input('input_transkrip')) {
            Document::where('user_id', Auth::id())
                ->where('type', 'file_transkrip')
                ->where('is_active', true)
                ->update(['jumlah' => $request->input('input_transkrip')]);
        }

        if ($request->hasFile('file_akta')) {
            Document::where('user_id', Auth::id())
                ->where('type', 'file_akta')
                ->update(['is_active' => false]);

            Document::create([
                'user_id' => Auth::id(),
                'file' => 'storage/' . $request->file('file_akta')->store('documents', 'public'),
                'file_name' => $request->file('file_akta')->getClientOriginalName(),
                'type' => 'file_akta',
                'jumlah' => $request->input('input_akta'),
                'is_active' => true,
            ]);
        }

        if (!$request->hasFile('file_akta') && $request->input('input_akta')) {
            Document::where('user_id', Auth::id())
                ->where('type', 'file_akta')
                ->where('is_active', true)
                ->update(['jumlah' => $request->input('input_akta')]);
        }

        $this->logServices->createLog(
            'Update Document',
            'Mahasiswa mengunggah dokumen legalisir',
            Auth::id()
        );

        return redirect()->route('mahasiswa.legalisir.index')->with('success', 'Dokumen berhasil diunggah atau diperbarui!');
    }
}
