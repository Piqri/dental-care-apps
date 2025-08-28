<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Search query
        $search = $request->input('search');

        // Sorting
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc'); // Default: newest first

        $pasien = Pasien::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nik', 'like', '%' . $search . '%')
                    ->orWhere('no_wa', 'like', '%' . $search . '%');
            })
            ->orderBy($sort, $direction)
            ->paginate(10);

        // Calculate age for each patient
        $pasien->each(function ($item) {
            $item->umur = \Carbon\Carbon::parse($item->tanggal_lahir)->age;
        });

        return view('pasien.index', compact('pasien'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pasien.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Base validation rules
        $rules = [
            'nama'           => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'   => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date|before_or_equal:today',
            'no_wa'          => 'required|string|max:15|regex:/^[0-9]+$/',
            'alamat'         => 'required|string|max:500',
            'jenis_pasien'   => 'required|in:ibu_hamil,anak_sekolah,caten',
        ];

        // Additional rules based on patient type
        switch ($request->jenis_pasien) {
            case 'anak_sekolah':
                $rules['nama_orang_tua'] = 'required|string|max:255';
                break;

            case 'ibu_hamil':
            case 'caten':
                $rules['nik'] = [
                    'required',
                    'string',
                    'max:16',
                    'min:16',
                    'regex:/^[0-9]+$/',
                ];
                break;
        }

        $messages = [
            'required'          => 'Field :attribute wajib diisi.',
            'nik.unique'       => 'NIK ini sudah terdaftar dalam sistem.',
            'nik.min'          => 'NIK harus terdiri dari 16 digit.',
            'nik.max'          => 'NIK maksimal 16 digit.',
            'nik.regex'        => 'NIK hanya boleh berisi angka.',
            'no_wa.regex'      => 'Nomor WhatsApp hanya boleh berisi angka.',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'jenis_pasien.in'  => 'Jenis pasien tidak valid',
        ];

        $attributes = [
            'nama'           => 'Nama Lengkap',
            'jenis_kelamin'  => 'Jenis Kelamin',
            'tempat_lahir'   => 'Tempat Lahir',
            'tanggal_lahir'  => 'Tanggal Lahir',
            'no_wa'          => 'Nomor WhatsApp',
            'alamat'         => 'Alamat',
            'nik'           => 'NIK',
            'nama_orang_tua' => 'Nama Orang Tua',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan dalam pengisian form.');
        }

        try {
            Pasien::create($request->only([
                'nama',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'no_wa',
                'alamat',
                'jenis_pasien',
                'nik',
                'nama_orang_tua'
            ]));

            return redirect()->route('pasien.index')
                ->with('success', 'Data pasien berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pasien = Pasien::with([
            'pregnantDentalCheckups',
            'catenDentalCheckups',
            'schoolChildDentalCheckups'
        ])->findOrFail($id);

        return view('pasien.show', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);

        return view('pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);

        // Base validation rules
        $rules = [
            'nama'           => 'required|string|max:255',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'   => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date|before_or_equal:today',
            'no_wa'          => 'required|string|max:15|regex:/^[0-9]+$/',
            'alamat'         => 'required|string|max:500',
            'jenis_pasien'   => 'required|in:ibu_hamil,anak_sekolah,caten',
        ];

        // Additional rules based on patient type
        switch ($request->jenis_pasien) {
            case 'anak_sekolah':
                $rules['nama_orang_tua'] = 'required|string|max:255';
                break;

            case 'ibu_hamil':
            case 'caten':
                $rules['nik'] = [
                    'required',
                    'string',
                    'max:16',
                    'min:16',
                    'regex:/^[0-9]+$/',
                ];
                break;
        }

        $messages = [
            'required'          => 'Field :attribute wajib diisi.',
            'nik.unique'       => 'NIK ini sudah terdaftar dalam sistem.',
            'nik.min'          => 'NIK harus terdiri dari 16 digit.',
            'nik.max'          => 'NIK maksimal 16 digit.',
            'nik.regex'        => 'NIK hanya boleh berisi angka.',
            'no_wa.regex'      => 'Nomor WhatsApp hanya boleh berisi angka.',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'jenis_pasien.in'  => 'Jenis pasien tidak valid',
        ];

        $attributes = [
            'nama'           => 'Nama Lengkap',
            'jenis_kelamin'  => 'Jenis Kelamin',
            'tempat_lahir'   => 'Tempat Lahir',
            'tanggal_lahir'  => 'Tanggal Lahir',
            'no_wa'          => 'Nomor WhatsApp',
            'alamat'         => 'Alamat',
            'nik'            => 'NIK',
            'nama_orang_tua' => 'Nama Orang Tua',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan dalam pengisian form.');
        }

        try {
            $pasien->update($request->only([
                'nama',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'no_wa',
                'alamat',
                'jenis_pasien',
                'nik',
                'nama_orang_tua'
            ]));

            return redirect()->route('pasien.index')
                ->with('success', 'Data pasien berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pasien = Pasien::findOrFail($id);

            // Hapus semua data pemeriksaan terkait terlebih dahulu
            switch ($pasien->jenis_pasien) {
                case 'ibu_hamil':
                    $pasien->pregnantDentalCheckups()->delete();
                    break;
                case 'caten':
                    $pasien->catenDentalCheckups()->delete();
                    break;
                case 'anak_sekolah':
                    $pasien->schoolChildDentalCheckups()->delete();
                    break;
            }

            // Hapus data pasien
            $pasien->delete();

            return redirect()->route('pasien.index')
                ->with('success', 'Data pasien berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data pasien: ' . $e->getMessage());
        }
    }
}
