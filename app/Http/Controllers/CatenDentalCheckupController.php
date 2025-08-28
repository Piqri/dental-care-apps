<?php

namespace App\Http\Controllers;

use App\Models\CatenDentalCheckup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\Pdf;

class CatenDentalCheckupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $checkups = CatenDentalCheckup::with('pasien')
            ->when($search, function ($query, $search) {
                return $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('nik', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('caten-dental-checkups.index', compact('checkups', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('caten-dental-checkups.create');
    }

    public function createWithPasien(Pasien $pasien)
    {
        return view('caten-dental-checkups.create', [
            'pasien' => $pasien
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'gigi_berlubang' => 'nullable|in:Ya,Tidak',
            'riwayat_sakit_gigi' => 'nullable|in:Ya,Tidak',
            'terakhir_sakit_gigi' => 'nullable|date',
            'gusi_bengkak' => 'nullable|in:Ya,Tidak',
            'sisa_akar' => 'nullable|in:Ya,Tidak',
            'gusi_berdarah' => 'nullable|in:Ya,Tidak',
            'gigi_goyang' => 'nullable|in:Ya,Tidak',
            'sariawan' => 'nullable|in:Ya,Tidak',
            'kondisi_karies' => 'nullable|boolean',
            'kondisi_sisa_akar' => 'nullable|boolean',
            'kondisi_karang_gigi' => 'nullable|boolean',
            'kondisi_gusi_bengkak' => 'nullable|boolean',
            'kondisi_gigi_goyang' => 'nullable|boolean',
            'kondisi_pendarahan' => 'nullable|boolean',
            'saran_konsultasi' => 'nullable|string|max:255',
            'saran_kontrol_rutin' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        $validated['saran_konsultasi'] = $validated['saran_konsultasi'] ?? 'Tidak';
        $validated['saran_kontrol_rutin'] = $validated['saran_kontrol_rutin'] ?? 'Tidak';

        try {
            DB::beginTransaction();

            // Simpan data pemeriksaan
            $checkup = CatenDentalCheckup::create($validated);

            DB::commit();

            return redirect()->route('caten-dental-checkups.index')
                ->with('success', 'Data pemeriksaan caten berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CatenDentalCheckup $catenDentalCheckup)
    {
        $catenDentalCheckup->load('pasien');
        return view('caten-dental-checkups.show', compact('catenDentalCheckup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CatenDentalCheckup $catenDentalCheckup)
    {
        return view('caten-dental-checkups.edit', compact('catenDentalCheckup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CatenDentalCheckup $catenDentalCheckup)
    {
        // Validasi data
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'gigi_berlubang' => 'nullable|in:Ya,Tidak',
            'riwayat_sakit_gigi' => 'nullable|in:Ya,Tidak',
            'terakhir_sakit_gigi' => 'nullable|date',
            'gusi_bengkak' => 'nullable|in:Ya,Tidak',
            'sisa_akar' => 'nullable|in:Ya,Tidak',
            'gusi_berdarah' => 'nullable|in:Ya,Tidak',
            'gigi_goyang' => 'nullable|in:Ya,Tidak',
            'sariawan' => 'nullable|in:Ya,Tidak',
            'kondisi_karies' => 'nullable|boolean',
            'kondisi_sisa_akar' => 'nullable|boolean',
            'kondisi_karang_gigi' => 'nullable|boolean',
            'kondisi_gusi_bengkak' => 'nullable|boolean',
            'kondisi_gigi_goyang' => 'nullable|boolean',
            'kondisi_pendarahan' => 'nullable|boolean',
            'saran_konsultasi' => 'nullable|string|max:255',
            'saran_kontrol_rutin' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            //konversi checkbox values
            $checkboxFields = [
                'kondisi_karies', 'kondisi_sisa_akar', 'kondisi_karang_gigi',
                'kondisi_gusi_bengkak', 'kondisi_gigi_goyang', 'kondisi_pendarahan'
            ];

            foreach ($checkboxFields as $field) {
                $validated[$field] = $request->has($field) ? true : false;
            }

            // Handle saran checkboxes
            $validated['saran_konsultasi'] = $request->has('saran_konsultasi') ? 'Ya' : 'Tidak';
            $validated['saran_kontrol_rutin'] = $request->has('saran_kontrol_rutin') ? 'Ya' : 'Tidak';

            // Update data pemeriksaan
            $catenDentalCheckup->update($validated);

            DB::commit();

            return redirect()->route('caten-dental-checkups.index')
                ->with('success', 'Data pemeriksaan caten berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatenDentalCheckup $catenDentalCheckup)
    {
        try {
            DB::beginTransaction();

            $catenDentalCheckup->delete();

            DB::commit();

            return redirect()->route('caten-dental-checkups.index')
                ->with('success', 'Data pemeriksaan caten berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function searchPasien(Request $request)
    {
        $search = $request->input('q');

        $result = Pasien::where('jenis_pasien', 'caten')        // ← tambah filter jenis pasien
            ->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%");
            })
            ->orderBy('nama')
            ->limit(20)
            ->get();

        return response()->json(
            $result->map(function ($p) {
                return [
                    'id' => $p->id,
                    'text' => "{$p->nama} (NIK: {$p->nik}, {$p->umur} tahun)",
                ];
            })
        );
    }

    public function whatsappMessage($id)
    {
        $catenDentalCheckup = CatenDentalCheckup::with('pasien')->findOrFail($id);

        // Data kondisi gigi
        $kondisiFields = [
            'kondisi_karies' => 'KARIES',
            'kondisi_sisa_akar' => 'SISA AKAR',
            'kondisi_karang_gigi' => 'KARANG GIGI',
            'kondisi_gusi_bengkak' => 'GUSI BENGKAK',
            'kondisi_gigi_goyang' => 'GIGI GOYANG',
            'kondisi_pendarahan' => 'PENDARAHAN'
        ];

        // Membuat pesan
        $message = "HASIL PEMERIKSAAN GIGI CATEN\n\n";
        $message .= "Nama: {$catenDentalCheckup->pasien->nama}\n";
        $message .= "Tanggal: " . now()->translatedFormat('l, d F Y') . "\n\n";

        $message .= "HASIL PEMERIKSAAN:\n\n";

        // Menambahkan keluhan
        $keluhanFields = [
            'gigi_berlubang' => 'Gigi Berlubang',
            'riwayat_sakit_gigi' => 'Riwayat Sakit Gigi',
            'gusi_bengkak' => 'Gusi Bengkak',
            'sisa_akar' => 'Sisa Akar',
            'gusi_berdarah' => 'Gusi Berdarah',
            'gigi_goyang' => 'Gigi Goyang',
            'sariawan' => 'Sariawan'
        ];

        foreach ($keluhanFields as $field => $label) {
            $value = $catenDentalCheckup->$field == 'Ya' ? 'YA' : 'TIDAK';
            $message .= "{$label}: {$value}\n";
        }

        if ($catenDentalCheckup->terakhir_sakit_gigi) {
            $message .= "Terakhir Sakit Gigi: " . \Carbon\Carbon::parse($catenDentalCheckup->terakhir_sakit_gigi)->translatedFormat('d F Y') . "\n";
        }

        $message .= "\nKONDISI GIGI:\n";

        // Menambahkan kondisi gigi
        foreach ($kondisiFields as $field => $label) {
            $value = $catenDentalCheckup->$field ? 'ADA' : 'TIDAK ADA';
            $message .= "{$label}: {$value}\n";
        }

        $message .= "\nSARAN:\n";

        // Menambahkan saran
        if ($catenDentalCheckup->saran_konsultasi == 'Ya') {
            $message .= "• Disarankan untuk melakukan konsultasi dan perawatan ke dokter gigi\n";
        }

        if ($catenDentalCheckup->saran_kontrol_rutin == 'Ya') {
            $message .= "• Disarankan untuk melakukan kontrol rutin\n";
        }

        if ($catenDentalCheckup->catatan) {
            $message .= "\nCATATAN:\n{$catenDentalCheckup->catatan}\n";
        }

        $message .= "\nTerima kasih.";

        return response()->json([
            'message' => $message,
            'phone_number' => $catenDentalCheckup->pasien->no_wa
        ]);
    }

    public function print($id)
    {
        $catenDentalCheckup = CatenDentalCheckup::with('pasien')->findOrFail($id);

        $pdf = PDF::loadView('caten-dental-checkups.print', compact('catenDentalCheckup'));

        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Return the PDF for download
        return $pdf->stream('pemeriksaan-gigi-caten-'.$catenDentalCheckup->pasien->nama.'.pdf');
    }
}
