<?php

namespace App\Http\Controllers;

use App\Models\PregnantDentalCheckup;
use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PregnantDentalCheckupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get search query
        $search = $request->query('search');

        // Query with eager loading
        $query = PregnantDentalCheckup::with('pasien')
            ->when($search, function ($query, $search) {
                return $query->whereHas('pasien', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('nik', 'like', '%' . $search . '%');
                });
            });

        // Order by latest first
        $query->latest();

        // Paginate results
        $checkups = $query->paginate(10);

        return view('pregnant-dental-checkups.index', compact('checkups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pregnant-dental-checkups.create');
    }

    public function createWithPasien(Pasien $pasien)
    {
        return view('pregnant-dental-checkups.create', [
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
            'gigi_berdarah' => 'nullable|in:Ya,Tidak',
            'gusi_bengkak' => 'nullable|in:Ya,Tidak',
            'dikomentari_bau_mulut' => 'nullable|in:Ya,Tidak',
            'gigi_goyang' => 'nullable|in:Ya,Tidak',
            'sulit_mengunyah' => 'nullable|in:Ya,Tidak',
            'makanan_terselip' => 'nullable|in:Ya,Tidak',
            'gusi_sakit' => 'nullable|in:Ya,Tidak',
            'gigi_sakit' => 'nullable|in:Ya,Tidak',
            'keluhan_lain' => 'nullable|string|max:255',
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

        $validated['saran_konsultasi']    = $validated['saran_konsultasi']    ?? 'Tidak';
        $validated['saran_kontrol_rutin'] = $validated['saran_kontrol_rutin'] ?? 'Tidak';

        try {
            DB::beginTransaction();

            // Simpan data pemeriksaan
            $checkup = PregnantDentalCheckup::create($validated);

            DB::commit();

            return redirect()->route('pregnant-dental-checkups.index')
                ->with('success', 'Data pemeriksaan gigi ibu hamil berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PregnantDentalCheckup $pregnantDentalCheckup)
    {
        $pregnantDentalCheckup->load('pasien');

        return view('pregnant-dental-checkups.show', compact('pregnantDentalCheckup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PregnantDentalCheckup $pregnantDentalCheckup)
    {
        $pregnantDentalCheckup->load('pasien');

        return view('pregnant-dental-checkups.edit', compact('pregnantDentalCheckup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PregnantDentalCheckup $pregnantDentalCheckup)
    {
        // Validasi data
        $validated = $request->validate([
            'gigi_berdarah' => 'nullable|in:Ya,Tidak',
            'gusi_bengkak' => 'nullable|in:Ya,Tidak',
            'dikomentari_bau_mulut' => 'nullable|in:Ya,Tidak',
            'gigi_goyang' => 'nullable|in:Ya,Tidak',
            'sulit_mengunyah' => 'nullable|in:Ya,Tidak',
            'makanan_terselip' => 'nullable|in:Ya,Tidak',
            'gusi_sakit' => 'nullable|in:Ya,Tidak',
            'gigi_sakit' => 'nullable|in:Ya,Tidak',
            'keluhan_lain' => 'nullable|string|max:255',
            'kondisi_karies' => 'nullable|boolean',
            'kondisi_sisa_akar' => 'nullable|boolean',
            'kondisi_karang_gigi' => 'nullable|boolean',
            'kondisi_gusi_bengkak' => 'nullable|boolean',
            'kondisi_gigi_goyang' => 'nullable|boolean',
            'kondisi_pendarahan' => 'nullable|boolean',
            'saran_konsultasi' => 'nullable|in:Ya,Tidak',
            'saran_kontrol_rutin' => 'nullable|in:Ya,Tidak',
            'catatan' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Konversi checkbox values
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
            $pregnantDentalCheckup->update($validated);

            DB::commit();

            return redirect()->route('pregnant-dental-checkups.index')
                ->with('success', 'Data pemeriksaan gigi ibu hamil berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PregnantDentalCheckup $pregnantDentalCheckup)
    {
        try {
            DB::beginTransaction();

            $pregnantDentalCheckup->delete();

            DB::commit();

            return redirect()->route('pregnant-dental-checkups.index')
                ->with('success', 'Data pemeriksaan gigi ibu hamil berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

     /**
     * AJAX Search for pasien
     */
    public function searchPasien(Request $request)
    {
        $search = $request->input('q');

        $result = Pasien::where('jenis_pasien', 'ibu_hamil')        // ← tambah filter jenis pasien
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
        $checkup = PregnantDentalCheckup::with('pasien')->findOrFail($id);

        $kondisiFields = [
            'kondisi_karies' => 'KARIES',
            'kondisi_sisa_akar' => 'SISA AKAR',
            'kondisi_karang_gigi' => 'KARANG GIGI',
            'kondisi_gusi_bengkak' => 'GUSI BENGKAK',
            'kondisi_gigi_goyang' => 'GIGI GOYANG',
            'kondisi_pendarahan' => 'PENDARAHAN'
        ];

        $message = "HASIL PEMERIKSAAN GIGI IBU HAMIL\n\n";
        $message .= "Nama: {$checkup->pasien->nama}\n";
        $message .= "Tanggal: " . now()->translatedFormat('l, d F Y') . "\n\n";

        $message .= "HASIL PEMERIKSAAN:\n";

        foreach ($kondisiFields as $field => $label) {
            $message .= "{$label} : " . ($checkup->$field ? 'ADA' : 'TIDAK') . "\n";
        }

        $message .= "\n";

        if ($checkup->saran_konsultasi == 'Ya') {
            $message .= "Disarankan untuk melakukan konsultasi dan perawatan ke dokter gigi\n";
        }

        if ($checkup->saran_kontrol_rutin == 'Ya') {
            $message .= "Disarankan untuk melakukan kontrol rutin 6x sekali\n";
        }

        return response()->json([
            'message' => $message,
            'phone' => $checkup->pasien->no_wa
        ]);
    }

    public function print($id)
    {
        $pregnantDentalCheckup = PregnantDentalCheckup::with('pasien')->findOrFail($id);

        $pdf = PDF::loadView('pregnant-dental-checkups.print', compact('pregnantDentalCheckup'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('pemeriksaan-gigi-ibu-hamil-'.$pregnantDentalCheckup->pasien->nama.'.pdf');
    }

}
