<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\JenisTenagaKontrak;
use App\Models\Kecamatan;
use App\Models\Pegawai;
use App\Models\Pendidikan;
use App\Models\UnitKerja;
use App\Models\Usulan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $satuan_kerja_id = Auth::user()->satuan_kerja_id;
        $pagination = 15;
                      
        $absensi = DB::table('pegawais')
        ->leftJoin('unit_kerjas', 'pegawais.unit_kerja_id', '=', 'unit_kerjas.id')
        ->leftJoin('satuan_kerjas', 'unit_kerjas.satuan_kerja_id', '=', 'satuan_kerjas.id')
        ->leftJoin('absensi_2021', 'pegawais.id', '=', 'absensi_2021.pegawai_id')
        ->select('pegawais.id', 'nik', 'nama', 'kehadiran', 'ketidakhadiran')
        ->where('satuan_kerjas.id', '=', $satuan_kerja_id)
        ->where('pegawais.status', '=', 1)
        ->paginate($pagination);
        return view('absensi.index', ['pegawais' => $absensi])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'kehadiran' => 'required|integer|max:248',
            'ketidakhadiran' => 'required|integer',
        ];
        $messages = [
            'required' => ':attribute harus diisi...!',
            'integer' => ':attribute harus bilangan bulat',
            'max' => ':attribute maksimal :max',
        ];
        $customAttributes = [
            'kehadiran' => 'Kehadiran',
            'ketidakhadiran' => 'Ketidakhadiran',
        ];
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        if ($validator->fails())
        {
            return redirect()->route('absensi.edit', $request->pegawai_id)->withErrors($validator)->withInput();
        } else {
            $absensi = new Absensi;

            $absensi->pegawai_id = $request->pegawai_id;
            $absensi->kehadiran = $request->kehadiran;
            $absensi->ketidakhadiran = $request->ketidakhadiran;

            $absensi->save();

            $request->session()->flash("message", "Absensi berhasil diperbarui!");
            return redirect()->route('absensi.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('absensi.edit', ['pegawai' => $pegawai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
