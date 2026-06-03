<?php

namespace App\Http\Controllers;

use App\Models\Jaminan;
use App\Models\Sewa;
use Illuminate\Http\Request;

class JaminanController extends Controller
{
    public function show($id_tr_sewa)
    {
        $sewa = Sewa::with(['kendaraan', 'jaminan'])->findOrFail($id_tr_sewa);

        // Pastikan hanya pelanggan pemilik sewa yang bisa akses
        $user = auth()->user();

        if (
            strtolower($user->level) === 'pelanggan' &&
            isset($user->pelanggan) &&
            $sewa->id_pelanggan != $user->pelanggan->id_pelanggan
        ) {
            abort(403);
        }

        return view('jaminan.show', compact('sewa'));
    }

    public function store(Request $request, $id_tr_sewa)
    {
        $request->validate([
            'ktp'              => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'kk'               => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'simA'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'rekening'         => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'rekening_listrik' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'rumah'            => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'foto_wajah'       => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'motor'       => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $sewa = Sewa::findOrFail($id_tr_sewa);

        $data = ['id_tr_sewa' => $id_tr_sewa];

        $fields = ['ktp', 'kk', 'simA', 'rekening', 'rekening_listrik', 'rumah', 'foto_wajah', 'motor'];

        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store("jaminan/{$id_tr_sewa}", 'public');
                $data[$field] = $path;
            }
        }

        Jaminan::updateOrCreate(
            ['id_tr_sewa' => $id_tr_sewa],
            $data
        );

        return redirect()->route('payment', $id_tr_sewa)
            ->with('success', 'Dokumen berhasil dikirim. Lanjutkan pembayaran.');
    }

    public function adminShow($id_tr_sewa)
    {
        $sewa = Sewa::with(['pelanggan', 'jaminan'])->findOrFail($id_tr_sewa);
        return response()->json([
            'jaminan' => $sewa->jaminan,
            'pelanggan' => $sewa->pelanggan->nama_pelanggan ?? '-',
        ]);
    }

    public function getUserJaminan($id_tr_sewa)
    {
        $sewa = Sewa::with(['jaminan'])->findOrFail($id_tr_sewa);
        
        // Ensure user owns this rental
        $user = auth()->user();
        if ($user->level === 'Pelanggan') {
            if (!$user->pelanggan || $sewa->id_pelanggan !== $user->pelanggan->id_pelanggan) {
                abort(403);
            }
        }

        $jaminan = $sewa->jaminan;
        $documents = [];
        
        if ($jaminan) {
            $fields = ['ktp', 'kk', 'simA', 'rekening', 'rekening_listrik', 'rumah', 'foto_wajah', 'motor'];
            $labels = [
                'ktp' => 'KTP (Elektronik)',
                'kk' => 'Kartu Keluarga (KK)',
                'simA' => 'Foto SIM A',
                'rekening' => 'Mutasi Rekening (3 Bln)',
                'rekening_listrik' => 'Rekening Listrik/PBB',
                'rumah' => 'Foto Depan Rumah',
                'foto_wajah' => 'Selfie dengan KTP',
                'motor' => 'Foto Motor'
            ];

            foreach ($fields as $field) {
                if ($jaminan->$field) {
                    $documents[] = [
                        'field' => $field,
                        'label' => $labels[$field],
                        'path' => asset('storage/' . $jaminan->$field),
                        'url' => $jaminan->$field
                    ];
                }
            }
        }

        return response()->json([
            'jaminan' => $jaminan,
            'documents' => $documents,
        ]);
    }

    public function adminShowForm($id_tr_sewa)
{
    $sewa = Sewa::with(['kendaraan', 'pelanggan', 'jaminan'])->findOrFail($id_tr_sewa);
    return view('admin.booking.jaminan', compact('sewa'));
}

public function adminStore(Request $request, $id_tr_sewa)
{
    $request->validate([
        'ktp'              => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'kk'               => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'rekening'         => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'rekening_listrik' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'simA'             => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'motor'            => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'rumah'            => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'foto_wajah'       => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
    ]);

    $data = ['id_tr_sewa' => $id_tr_sewa];

    $fields = ['ktp', 'kk', 'rekening', 'rekening_listrik', 'simA', 'motor', 'rumah', 'foto_wajah'];

    foreach ($fields as $field) {
        if ($request->hasFile($field)) {
            $path = $request->file($field)->store("jaminan/{$id_tr_sewa}", 'public');
            $data[$field] = $path;
        }
    }

    \App\Models\Jaminan::updateOrCreate(
        ['id_tr_sewa' => $id_tr_sewa],
        $data
    );

    return redirect()->route('booking.admin.payment', ['id' => $id_tr_sewa])
        ->with('success', 'Dokumen berhasil dikirim.');
}

    
}