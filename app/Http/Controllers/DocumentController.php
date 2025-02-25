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
        $file_transkrip_1 = Document::where('user_id', $user->id)->where('type', 'file_transkrip_1')->where('is_active', true)->first();
        $file_transkrip_2 = Document::where('user_id', $user->id)->where('type', 'file_transkrip_2')->where('is_active', true)->first();
        $akta_mengajar = Document::where('user_id', $user->id)->where('type', 'akta_mengajar')->where('is_active', true)->first();
        return view('mahasiswa.legalisir.index', compact('user', 'file_ijazah', 'file_transkrip_1', 'file_transkrip_2', 'akta_mengajar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_ijazah' => 'nullable|mimes:jpg,jpeg,png|max:1024', // Tidak wajib jika hanya ingin mengganti sebagian
            'file_transkrip_1' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            'file_transkrip_2' => 'nullable|mimes:jpg,jpeg,png|max:1024',
            'akta_mengajar' => 'nullable|mimes:jpg,jpeg,png|max:1024',
        ], [
            'file_ijazah.mimes' => 'File Ijazah harus dalam format jpg, jpeg, atau png.',
            'file_transkrip_1.mimes' => 'File Transkrip Nilai harus dalam format jpg, jpeg, atau png.',
            'file_transkrip_2.mimes' => 'File Transkrip Nilai opsional harus dalam format jpg, jpeg, atau png.',
            'akta_mengajar.mimes' => 'File Akta Mengajar harus dalam format jpg, jpeg, atau png.',
            'file_ijazah.max' => 'Ukuran File Ijazah tidak boleh lebih dari 1 MB.',
            'file_transkrip_1.max' => 'Ukuran File Transkrip Nilai tidak boleh lebih dari 1 MB.',
            'file_transkrip_2.max' => 'Ukuran File Transkrip Nilai opsional tidak boleh lebih dari 1 MB.',
            'akta_mengajar.max' => 'Ukuran File Akta Mengajar tidak boleh lebih dari 1 MB.',
        ]);

        // Perbarui hanya file yang diunggah
        if ($request->hasFile('file_ijazah')) {
            // update semua dokuemn where user_id, type, is_active menjadi false
            Document::where('user_id', Auth::id())->where('type', 'file_ijazah')->update(['is_active' => false]);
            Document::create([
                'user_id' => Auth::id(),
                'file' => $request->file('file_ijazah')->store('documents', 'public'),
                'file_name' => $request->file('file_ijazah')->getClientOriginalName(),
                'type' => 'file_ijazah',
                'is_active' => true,
            ]);
            // $document->file_ijazah = $request->file('file_ijazah')->store('documents', 'public');
        }

        if ($request->hasFile('file_transkrip_1')) {
            Document::where('user_id', Auth::id())->where('type', 'file_transkrip_1')->update(['is_active' => false]);
            Document::create([
                'user_id' => Auth::id(),
                'file' => $request->file('file_transkrip_1')->store('documents', 'public'),
                'file_name' => $request->file('file_transkrip_1')->getClientOriginalName(),
                'type' => 'file_transkrip_1',
                'is_active' => true,
            ]);
        }

        if ($request->hasFile('file_transkrip_2')) {
            Document::where('user_id', Auth::id())->where('type', 'file_transkrip_2')->update(['is_active' => false]);
            Document::create([
                'user_id' => Auth::id(),
                'file' => $request->file('file_transkrip_2')->store('documents', 'public'),
                'file_name' => $request->file('file_transkrip_2')->getClientOriginalName(),
                'type' => 'file_transkrip_2',
                'is_active' => true,
            ]);
        }

        if ($request->hasFile('akta_mengajar')) {
            Document::where('user_id', Auth::id())->where('type', 'akta_mengajar')->update(['is_active' => false]);
            Document::create([
                'user_id' => Auth::id(),
                'file' => $request->file('akta_mengajar')->store('documents', 'public'),
                'file_name' => $request->file('akta_mengajar')->getClientOriginalName(),
                'type' => 'akta_mengajar',
                'is_active' => true,
            ]);
        }

        // Redirect ke halaman riwayat dengan pesan sukses
        return redirect()->route('mahasiswa.legalisir.index')->with('success', 'Dokumen berhasil diunggah atau diperbarui!');
    }
}
