<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\PregnantDentalCheckup;
use App\Models\SchoolChildDentalCheckup;
use App\Models\CatenDentalCheckup;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->query('month');   // 1..12 or null
        $selectedYear  = $request->query('year');    // 2023, 2024, ...
        $selectedJenis = $request->query('jenis');   // ibu_hamil | anak_sekolah | caten | null

        // ******** CHECKUPS base queries ********
        $pregnantBase = PregnantDentalCheckup::with('pasien');
        $schoolBase   = SchoolChildDentalCheckup::with('pasien');
        $catenBase    = CatenDentalCheckup::with('pasien');

        // helper clones untuk hitung count
        $pregnantForCount = (clone $pregnantBase);
        $schoolForCount   = (clone $schoolBase);
        $catenForCount    = (clone $catenBase);

        if ($selectedMonth) {
            $pregnantForCount->whereMonth('created_at', $selectedMonth);
            $schoolForCount->whereMonth('created_at', $selectedMonth);
            $catenForCount->whereMonth('created_at', $selectedMonth);
        }
        if ($selectedYear) {
            $pregnantForCount->whereYear('created_at', $selectedYear);
            $schoolForCount->whereYear('created_at', $selectedYear);
            $catenForCount->whereYear('created_at', $selectedYear);
        }

        $ibuHamilCount    = $pregnantForCount->count();
        $anakSekolahCount = $schoolForCount->count();
        $catenCount       = $catenForCount->count();

        // ******** TOTAL PASIEN sesuai filter (periksa pasien_id unik) ********
        if ($selectedJenis === 'ibu_hamil') {
            $totalPasien = $pregnantForCount->distinct('pasien_id')->count('pasien_id');
        } elseif ($selectedJenis === 'anak_sekolah') {
            $totalPasien = $schoolForCount->distinct('pasien_id')->count('pasien_id');
        } elseif ($selectedJenis === 'caten') {
            $totalPasien = $catenForCount->distinct('pasien_id')->count('pasien_id');
        } else {
            // Gabungkan semua pasien_id dari ketiga tabel lalu hitung unik
            $pasienIds = collect()
                ->merge($pregnantForCount->pluck('pasien_id'))
                ->merge($schoolForCount->pluck('pasien_id'))
                ->merge($catenForCount->pluck('pasien_id'))
                ->filter()   // buang null
                ->unique()
                ->values();
            $totalPasien = $pasienIds->count();
        }

        // ******** RECENTS (apply month/year) ********
        $pregnantForRecent = (clone $pregnantBase);
        $schoolForRecent   = (clone $schoolBase);
        $catenForRecent    = (clone $catenBase);

        if ($selectedMonth) {
            $pregnantForRecent->whereMonth('created_at', $selectedMonth);
            $schoolForRecent->whereMonth('created_at', $selectedMonth);
            $catenForRecent->whereMonth('created_at', $selectedMonth);
        }
        if ($selectedYear) {
            $pregnantForRecent->whereYear('created_at', $selectedYear);
            $schoolForRecent->whereYear('created_at', $selectedYear);
            $catenForRecent->whereYear('created_at', $selectedYear);
        }

        $recentIbuHamil = collect();
        $recentAnakSekolah = collect();
        $recentCaten = collect();

        if (!$selectedJenis || $selectedJenis === 'ibu_hamil') {
            $recentIbuHamil = $pregnantForRecent->latest()->take(5)->get();
        }
        if (!$selectedJenis || $selectedJenis === 'anak_sekolah') {
            $recentAnakSekolah = $schoolForRecent->latest()->take(5)->get();
        }
        if (!$selectedJenis || $selectedJenis === 'caten') {
            $recentCaten = $catenForRecent->latest()->take(5)->get();
        }

        // ******** RECENT PASIEN berdasarkan filter (ini yang sebelumnya hilang) ********
        $recentPasienIds = collect();

        if ($selectedJenis === 'ibu_hamil') {
            $recentPasienIds = $pregnantForRecent->pluck('pasien_id');
        } elseif ($selectedJenis === 'anak_sekolah') {
            $recentPasienIds = $schoolForRecent->pluck('pasien_id');
        } elseif ($selectedJenis === 'caten') {
            $recentPasienIds = $catenForRecent->pluck('pasien_id');
        } else {
            $recentPasienIds = collect()
                ->merge($pregnantForRecent->pluck('pasien_id'))
                ->merge($schoolForRecent->pluck('pasien_id'))
                ->merge($catenForRecent->pluck('pasien_id'));
        }

        $recentPasienIds = $recentPasienIds->filter()->unique()->values();

        if ($recentPasienIds->isEmpty()) {
            // fallback:
            // - jika tidak ada filter sama sekali, tampilkan latest pasien
            // - jika ada filter tapi tidak ada pasien dalam periode itu, kosongkan
            if (!$selectedMonth && !$selectedYear && !$selectedJenis) {
                $recentPasien = Pasien::latest()->take(6)->get();
            } else {
                $recentPasien = collect();
            }
        } else {
            $recentPasien = Pasien::whereIn('id', $recentPasienIds->all())->latest()->take(6)->get();
        }

        return view('dashboard', [
            'totalPasien' => $totalPasien,
            'ibuHamilCount' => $ibuHamilCount,
            'anakSekolahCount' => $anakSekolahCount,
            'catenCount' => $catenCount,
            'recentIbuHamil' => $recentIbuHamil,
            'recentAnakSekolah' => $recentAnakSekolah,
            'recentCaten' => $recentCaten,
            'recentPasien' => $recentPasien,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'selectedJenis' => $selectedJenis,
        ]);
    }
}
