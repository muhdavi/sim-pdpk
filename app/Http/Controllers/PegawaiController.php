<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $pagination = 15;
        if (Auth::user()->satuan_kerja_id) {
            $pegawais = Pegawai::when($request->keyword, function ($query) use ($request) {
                $query->where('nik', 'like', "%{$request->keyword}%")
                ->orWhere('nama', 'like', "%{$request->keyword}%");
            })->whereHas('unit_kerja', function ($query) {
                $query->where('satuan_kerja_id', '=', Auth::user()->satuan_kerja_id);
            })->orderBy('vaksin_kedua')->orderBy('spkk')->paginate($pagination);

            $pegawais->appends($request->only('keyword'));
        } else {
            $pegawais = Pegawai::when($request->keyword, function ($query) use ($request) {
                $query->where('nik', 'like', "%{$request->keyword}%")
                ->orWhere('nama', 'like', "%{$request->keyword}%");
            })->orderBy('status')->paginate($pagination);

            $pegawais->appends($request->only('keyword'));
        }
        return view('pegawai.index', ['pegawais' => $pegawais])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        if (Auth::user()->satuan_kerja_id) {
            $unit_kerjas = UnitKerja::where('satuan_kerja_id', Auth::user()->satuan_kerja_id)->get();
        } else {
            $unit_kerjas = UnitKerja::all();
        }
        $pendidikans = Pendidikan::all();
        $kecamatans = Kecamatan::orderBy('kecamatan')->get();
        $jenis_tekons = JenisTenagaKontrak::all();
        return view('pegawai.create', ['unit_kerjas' => $unit_kerjas, 'pendidikans' => $pendidikans, 'kecamatans' => $kecamatans, 'jenis_tekons' => $jenis_tekons]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'pendidikan' => 'required|not_in:-1',
            'unit_kerja' => 'required|not_in:-1',
        ];
        $messages = [
            'required' => ':attribute wajib diisi!',
            'not_in' => ':attribute harus dipilih!',
        ];
        $customAttributes = [
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'unit_kerja' => 'Unit Kerja'
        ];
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return redirect()->route('pegawai.create')->withErrors($validator)->withInput();
        } else {
            $pegawai = new Pegawai;

            $pegawai->nama = strtolower($request->nama);
            $pegawai->gelar_depan = $request->gelar_depan;
            $pegawai->gelar_belakang = $request->gelar_belakang;
            $pegawai->tempat_lahir = strtolower($request->tempat_lahir);
            $pegawai->tanggal_lahir = $request->tanggal_lahir;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->pendidikan_id = $request->pendidikan;
            $pegawai->unit_kerja_id = $request->unit_kerja;
            $pegawai->user_id = Auth::user()->id;

            $pegawai->save();

            $request->session()->flash("message", "Data pegawai berhasil disimpan!");
            return redirect()->route('pegawai.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Pegawai $pegawai
     */
    public function show(Pegawai $pegawai)
    {
        $data_pegawai = Pegawai::find($pegawai->id);
//        dd($data_pegawai->operator);
        return view('pegawai.show', ['pegawai' => $data_pegawai]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Pegawai $pegawai
     */
    public function edit(Pegawai $pegawai)
    {
        $data_pegawai = Pegawai::find($pegawai->id);
        $pendidikans = Pendidikan::all();
        $kecamatans = Kecamatan::orderBy('kecamatan')->get();
        $unit_kerjas = UnitKerja::where('satuan_kerja_id', Auth::user()->satuan_kerja_id)->orderBy('unit_kerja')->get();
        $jenis_tekons = JenisTenagaKontrak::all();
        //dd($data_pegawai->jenis_kelamin);
        return view('pegawai.edit', [
            'pegawai' => $data_pegawai,
            'pendidikans' => $pendidikans,
            'unit_kerjas' => $unit_kerjas,
            'kecamatans' => $kecamatans,
            'jenis_tekons' => $jenis_tekons,
            'selected_jenis_kelamin' => (int)$data_pegawai->jenis_kelamin,
            'selected_vaksin_pertama' => (int)$data_pegawai->vaksin_pertama,
            'selected_vaksin_kedua' => (int)$data_pegawai->vaksin_kedua,
            'selected_vaksin_ketiga' => (int)$data_pegawai->vaksin_ketiga,
            'selected_unit_kerja' => $data_pegawai->unit_kerja_id,
            'selected_pendidikan' => $data_pegawai->pendidikan_id,
            'selected_kecamatan' => $data_pegawai->kecamatan_id,
            'selected_jenis_tekon' => $data_pegawai->jenis_tenaga_kontrak_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pegawai $pegawai
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $data = $request->all();

        $enam = array('4', '5', '6', '7');
        $tujuh = array('8', '9', '10');

        $rules = [
            'nik' => 'required|size:16',
            'pendidikan' => 'required|not_in:-1',
            'unit_kerja' => 'required|not_in:-1',
            'kecamatan' => 'required|not_in:-1',
            'jenis_tekon' => 'required|not_in:-1',
            'tmt' => 'required',
            'vaksin_pertama' => 'required',
            'vaksin_kedua' => 'required',
            'foto' => 'mimes:jpeg,jpg,png',
            'ktp' => 'mimes:jpeg,jpg,pdf',
            'kk' => 'mimes:jpeg,jpg,pdf',
            'ijazah' => 'mimes:jpeg,jpg,pdf',
            'str' => 'mimes:jpeg,jpg,pdf',
        ];
        $messages = [
            'required' => ':attribute wajib diisi...!',
            'size' => ':attribute tidak lebih dari :size',
            'unique' => ':attribute telah terdaftar!',
        ];
        $customAttributes = [
            'nik' => 'Nomor Induk Kependudukan',
            'jenis_tekon' => 'Jenis Tenaga Kontrak',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'unit_kerja' => 'Unit Kerja',
            'foto' => 'Pasfoto',
            'kk' => 'KK',
            'ktp' => 'KTP',
            'tmt' => 'Terhitung Mulai Tanggal (TMT) Kerja',
            'vaksin_pertama' => 'Vaksin Pertama',
            'vaksin_kedua' => 'Vaksin Kedua',
        ];
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return redirect()->route('pegawai.edit', $pegawai->id)->withErrors($validator)->withInput();
        } else {

            if($request->jenis_tekon != 4) {
                if (in_array($request->pendidikan, $tujuh)) {
                    $honorarium = 500000;
                } elseif (in_array($request->pendidikan, $enam)) {
                    $honorarium = 500000;
                } else {
                    $honorarium = 500000;
                }
            } else {
                $honorarium = 600000;
            }

            $pegawai->nik = $request->nik;
            $pegawai->npwp = $request->npwp;
            $pegawai->nuptk = $request->nuptk;
            $pegawai->tempat_lahir = strtolower($request->tempat_lahir);
            $pegawai->tanggal_lahir = $request->tanggal_lahir;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->gelar_depan = $request->gelar_depan;
            $pegawai->gelar_belakang = $request->gelar_belakang;
            $pegawai->tanggal_lulus = $request->tanggal_lulus;
            $pegawai->nomor_ijazah = $request->nomor_ijazah;
            $pegawai->institusi = strtoupper($request->institusi);
            $pegawai->jurusan = strtoupper($request->jurusan);
            $pegawai->pendidikan_id = $request->pendidikan;
            $pegawai->unit_kerja_id = $request->unit_kerja;
            $pegawai->kecamatan_id = $request->kecamatan;
            $pegawai->alamat = strtolower($request->alamat);
            $pegawai->email = strtolower($request->email);
            $pegawai->no_hp = $request->no_hp;
            $pegawai->tmt = $request->tmt;
            $pegawai->honorarium = $honorarium;
            $pegawai->jenis_tenaga_kontrak_id = $request->jenis_tekon;
            $pegawai->jabatan_id = $request->jabatan;
            $pegawai->vaksin_pertama = $request->vaksin_pertama;
            $pegawai->vaksin_kedua = $request->vaksin_kedua;
            $pegawai->vaksin_ketiga = $request->vaksin_ketiga;
            $pegawai->spkk = $request->spkk;
            $pegawai->user_id = Auth::user()->id;

            if ($request->hasFile("foto")) {
                $foto = $request->foto;
                $fn_foto = $pegawai->nama . "_" . $pegawai->nik . "." . $foto->getClientOriginalExtension();
                $foto->move(public_path('foto'), $fn_foto);
                $pegawai->foto = $fn_foto;
            }

            if ($request->hasFile("ktp")) {
                $ktp = $request->ktp;
                $fn_ktp = $pegawai->nama . "_" . $pegawai->nik . "." . $ktp->getClientOriginalExtension();
                $ktp->move(public_path('ktp'), $fn_ktp);
                $pegawai->ktp = $fn_ktp;
            }

            if ($request->hasFile("kk")) {
                $kk = $request->kk;
                $fn_kk = $pegawai->nama . "_" . $pegawai->nik . "." . $kk->getClientOriginalExtension();
                $kk->move(public_path('kk'), $fn_kk);
                $pegawai->kk = $fn_kk;
            }

            if ($request->hasFile("ijazah")) {
                $ijazah = $request->ijazah;
                $fn_ijazah = $pegawai->nama . "_" . $pegawai->nik . "." . $ijazah->getClientOriginalExtension();
                $ijazah->move(public_path('ijazah'), $fn_ijazah);
                $pegawai->ijazah = $fn_ijazah;
            }

            if ($request->hasFile("str")) {
                $str = $request->str;
                $fn_str = $pegawai->nama . "_" . $pegawai->nik . "." . $str->getClientOriginalExtension();
                $str->move(public_path('str'), $fn_str);
                $pegawai->str = $fn_str;
            }

            $pegawai->update();
            return redirect()->route('pegawai.index')->with('message', 'Data pegawai berhasil diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Pegawai $pegawai
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai = Pegawai::findOrFail($pegawai->id);
        $pegawai->status = 2;
        $pegawai->update();
        return redirect()->route('pegawai.index')->with('message', 'Pegawai berhasil di-nonaktif-kan!');
    }

    public function usulkan(Pegawai $pegawai)
    {
        $pegawai->status = true;
        $pegawai->update();
        $usulan = new Usulan;
        $usulan->periode = now()->year;
        $usulan->pegawai_id = $pegawai->id;
        $usulan->save();
        return redirect()->route('pegawai.index')->with('message', 'Pegawai telah diusulkan!');
    }

    public function reject(Pegawai $pegawai)
    {
        $data_pegawai = Pegawai::find($pegawai->id);
        $usulan = $data_pegawai->usulan->first();
        return view('pegawai.reject', ['usulan' => $usulan, 'pegawai' => $data_pegawai]);
    }

    public function dashboard()
    {
        $dpdpk_lk = Pegawai::where('status', true)->where('jenis_kelamin', 1)->get();
        $dpdpk_pr = Pegawai::where('status', true)->where('jenis_kelamin', 0)->get();

        $data = DB::select('SELECT satuan_kerjas.nama_singkat, satuan_kerjas.satuan_kerja, satuan_kerjas.kouta, COUNT(nik) AS data_isi, (satuan_kerjas.kouta-COUNT(nik)) AS data_kosong FROM pegawais RIGHT JOIN satuan_kerjas ON satuan_kerjas.id=pegawais.user_id WHERE status <> 2 GROUP BY pegawais.user_id ORDER BY `satuan_kerjas`.`id` ASC');
        $data_namaopd = [];
        $data_updated = [];
        $data_updating = [];
        $data_kouta = [];
        foreach ( $data as $d ) {
			array_push ( $data_namaopd, $d->nama_singkat );
        }
        foreach ( $data as $d ) {
			array_push ( $data_updated, $d->data_isi );
        }
        foreach ( $data as $d ) {
			array_push ( $data_updating, $d->data_kosong );
        }
        foreach ( $data as $d ) {
			array_push ( $data_kouta, $d->kouta );
        }
        $satuan_kerja = json_encode($data_namaopd);
        $kouta = json_encode($data_kouta, JSON_NUMERIC_CHECK);
        $updated = json_encode($data_updated, JSON_NUMERIC_CHECK);
        $updating = json_encode($data_updating, JSON_NUMERIC_CHECK);
        $pdpk_lk = $dpdpk_lk->count();
        $pdpk_pr = $dpdpk_pr->count();
        //dd();
        return view('dashboard', [
            'pdpk_lk' => $pdpk_lk,
            'pdpk_pr' => $pdpk_pr,
            'jkouta' => array_sum($data_kouta),
            'jupdated' => array_sum($data_updated),
            'data' => $data,
            'satuan_kerja' => $satuan_kerja,
            'updated' => $updated,
            'updating' => $updating,
            'kouta' => $kouta
        ]);
    }

    public function home(Request $request)
    {
        $paginate = 15;
        $usulans = Usulan::where('status', true)->orderBy('satuan_kerja_id')->paginate($paginate);
        return view('landing', ['usulans' => $usulans])->with('i', ($request->input('page', 1) - 1) * $paginate);
    }

    public function selectUnitKerja(Request $request)
    {
        if ($request->has('unit_kerja')) {
    		$cari = $request->unit_kerja;
    		//$data = DB::table('unit_kerjas')->select('id', 'unit_kerja')->where('unit_kerja', 'LIKE', '%$cari%')->get();
    		$data = UnitKerja::select("id","unit_kerja")
            		->Where('satuan_kerja_id', Auth::user()->satuan_kerja_id)
            		->where('unit_kerja','LIKE',"%$cari%")
            		->get();
    		return response()->json($data);
    	}
    }

    public function move()
    {
        $doks = Pegawai::whereNotNull('str')->orderBy('str')->get();
        foreach ($doks as $dok) {
            if (File::exists(public_path('str/'. $dok->str))) {
                File::copy(public_path('str/' . $dok->str), public_path('str2/' . $dok->str));
            } else {
                dd($dok->str);
            }
        }
    }
}
