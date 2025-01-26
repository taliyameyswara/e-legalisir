<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $document = Document::where('user_id', $user->id)->first();

        return view('mahasiswa.dashboard', compact('user', 'document'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_ijazah' => 'required|mimes:pdf|max:2048',
            'file_transkrip_1' => 'required|mimes:pdf|max:2048',
            'file_transkrip_2' => 'nullable|mimes:pdf|max:2048',
        ]);

        $document = Document::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'file_ijazah' => $request->file('file_ijazah')->store('documents'),
                'file_transkrip_1' => $request->file('file_transkrip_1')->store('documents'),
                'file_transkrip_2' => $request->hasFile('file_transkrip_2') ? $request->file('file_transkrip_2')->store('documents') : null,
                'status' => 'menunggu pembayaran',
            ]
        );

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Dokumen berhasil diunggah!');
    }

    public function submit(Request $request)
    {
        $document = Document::where('user_id', Auth::id())->first();

        if (!$document || !$document->file_ijazah || !$document->file_transkrip_1) {
            return redirect()->back()->withErrors(['error' => 'Lengkapi dokumen sebelum mengajukan legalisir.']);
        }

        $document->update(['status' => 'pending']);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pengajuan legalisir berhasil!');
    }
}
