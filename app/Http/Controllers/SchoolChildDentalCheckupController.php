<?php

namespace App\Http\Controllers;

use App\Models\SchoolChildDentalCheckup;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SchoolChildDentalCheckupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $checkups = SchoolChildDentalCheckup::with('pasien')
            ->when($search, function($query, $search) {
                return $query->whereHas('pasien', function($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('nik', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        // Calculate statistics
        $stats = [
            'need_action' => SchoolChildDentalCheckup::where(function($q) {
                $q->where('saran_konsultasi', 'Ya')
                  ->orWhere('saran_kontrol_rutin', 'Ya');
            })->count()
        ];
            
        return view('school-child-dental-checkups.index', compact('checkups', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school-child-dental-checkups.create');
    }

    public function createWithPasien(Pasien $pasien)
    {
    return view('school-child-dental-checkups.create', [
        'pasien' => $pasien
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'kondisi_karies' => 'nullable|boolean',
            'kondisi_karang_gigi' => 'nullable|boolean',
            'kondisi_gigi_goyang' => 'nullable|boolean',
            'jumlah_gigi' => 'required|in:normal,berlebih,kurang',
            'kondisi_sisa_akar' => 'nullable|boolean',
            'saran_konsultasi' => 'nullable|string',
            'saran_kontrol_rutin' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $validated['saran_konsultasi'] = $validated['saran_konsultasi'] ?? 'Tidak';
        $validated['saran_kontrol_rutin'] = $validated['saran_kontrol_rutin'] ?? 'Tidak';

        try {
            DB::beginTransaction();

            // Simpan data pemeriksaan
            $checkup = SchoolChildDentalCheckup::create($validated);

            DB::commit();

            return redirect()->route('school-child-dental-checkups.index')
                ->with('success', 'Data pemeriksaan gigi anak sekolah berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $schoolChildDentalCheckup = SchoolChildDentalCheckup::with('pasien')->findOrFail($id);
            return view('school-child-dental-checkups.show', compact('schoolChildDentalCheckup'));
        } catch (\Exception $e) {
            return redirect()->route('school-child-dental-checkups.index')
                ->with('error', 'Data pemeriksaan tidak ditemukan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SchoolChildDentalCheckup $schoolChildDentalCheckup)
    {
        $schoolChildDentalCheckup->load('pasien');
        return view('school-child-dental-checkups.edit', compact('schoolChildDentalCheckup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolChildDentalCheckup $schoolChildDentalCheckup)
    {
        $validated = $request->validate([
            'kondisi_karies' => 'nullable|boolean',
            'kondisi_karang_gigi' => 'nullable|boolean',
            'kondisi_gigi_goyang' => 'nullable|boolean',
            'jumlah_gigi' => 'required|in:normal,berlebih,kurang',
            'kondisi_sisa_akar' => 'nullable|boolean',
            'saran_konsultasi' => 'nullable|string',
            'saran_kontrol_rutin' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        // Convert checkbox values
        $validated['kondisi_karies'] = $request->has('kondisi_karies');
        $validated['kondisi_karang_gigi'] = $request->has('kondisi_karang_gigi');
        $validated['kondisi_gigi_goyang'] = $request->has('kondisi_gigi_goyang');
        $validated['kondisi_sisa_akar'] = $request->has('kondisi_sisa_akar');
        $validated['saran_konsultasi'] = $request->has('saran_konsultasi') ? 'Ya' : 'Tidak';
        $validated['saran_kontrol_rutin'] = $request->has('saran_kontrol_rutin') ? 'Ya' : 'Tidak';

        try {
            DB::beginTransaction();

            // Update data pemeriksaan
            $schoolChildDentalCheckup->update($validated);

            DB::commit();

            return redirect()->route('school-child-dental-checkups.index')
                ->with('success', 'Data pemeriksaan gigi anak sekolah berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolChildDentalCheckup $schoolChildDentalCheckup)
    {
        try {
            DB::beginTransaction();

            $schoolChildDentalCheckup->delete();

            DB::commit();

            return redirect()->route('school-child-dental-checkups.index')
                ->with('success', 'Data pemeriksaan gigi anak sekolah berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function whatsappMessage($id)
    {
        $checkup = SchoolChildDentalCheckup::with('pasien')->findOrFail($id);

        $kondisiFields = [
            'kondisi_karies'      => 'KARIES',
            'kondisi_karang_gigi' => 'KARANG GIGI',
            'kondisi_gigi_goyang' => 'GIGI GOYANG',
            'kondisi_sisa_akar'   => 'SISA AKAR',
        ];

        // Buat hash dari ID
        $hash = hash('sha256', $checkup->id . config('app.key'));

        // Buat link publik dengan hash
        $linkHasil = url('/school-child-dental-checkups/public/' . $hash);

        $message = "HASIL PEMERIKSAAN GIGI ANAK SEKOLAH\n\n";
        $message .= "Nama: {$checkup->pasien->nama}\n";
        $message .= "Tanggal: " . now()->translatedFormat('l, d F Y') . "\n\n";

        $message .= "HASIL PEMERIKSAAN:\n";
        foreach ($kondisiFields as $field => $label) {
            $value = $checkup->$field ? 'ADA' : 'TIDAK ADA';
            $message .= "{$label} : {$value}\n";
        }

        $message .= "JUMLAH GIGI : " . strtoupper($checkup->jumlah_gigi) . "\n\n";

        $message .= "SARAN:\n";
        if ($checkup->saran_konsultasi === 'Ya') {
            $message .= "- Disarankan untuk melakukan konsultasi dan perawatan ke dokter gigi\n";
        }
        if ($checkup->saran_kontrol_rutin === 'Ya') {
            $message .= "- Disarankan untuk melakukan kontrol rutin\n";
        }

        if (!empty($checkup->catatan)) {
            $message .= "\nCATATAN:\n{$checkup->catatan}\n";
        }

        $message .= "\n🔗 *LINK HASIL PEMERIKSAAN LENGKAP:*\n{$linkHasil}\n\n";
        $message .= "Terima kasih.";

        $encodedMessage = urlencode($message);

        $phone = $checkup->pasien->no_wa;
        $phone = preg_replace('/^\+/', '', $phone);
        $phone = preg_replace('/^0/', '62', $phone);

        return redirect()->away("https://wa.me/{$phone}?text={$encodedMessage}");
    }



    public function print($id)
    {
        $schoolChildDentalCheckup = SchoolChildDentalCheckup::with('pasien')->findOrFail($id);

        $pdf = PDF::loadView('school-child-dental-checkups.print', compact('schoolChildDentalCheckup'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('pemeriksaan-gigi-anak-sekolah-'.$schoolChildDentalCheckup->pasien->nama.'.pdf');
    }
    
    public function searchPasien(Request $request)
    {
        $search = $request->input('q');

        $result = Pasien::where('jenis_pasien', 'anak_sekolah')        // ← tambah filter jenis pasien
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
    
    public function showPublic($hash)
    {
        // Cari data dengan validasi hash
        $checkup = SchoolChildDentalCheckup::with('pasien')->get()
            ->first(function ($item) use ($hash) {
                return hash('sha256', $item->id . config('app.key')) === $hash;
            });

        if (!$checkup) {
            abort(404, 'Data pemeriksaan tidak ditemukan.');
        }

        return view('school-child-dental-checkups.show', [
            'schoolChildDentalCheckup' => $checkup
        ]);
    }

}
