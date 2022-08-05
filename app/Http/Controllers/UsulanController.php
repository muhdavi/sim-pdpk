<?php

namespace App\Http\Controllers;

use DB;
use QrCode;
use App\Models\Pegawai;
use App\Models\PegawaiUsulan;
use App\Models\Periode;
use App\Models\SatuanKerja;
use App\Models\Usulan;
use App\Models\DokumenPelaksanaanAnggaran;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pagination = 15;
        if (Auth::user()->satuan_kerja_id) {
            $usulans = Usulan::where('satuan_kerja_id', Auth::user()->satuan_kerja_id)->where('status', true)->paginate($pagination);
            $kouta = SatuanKerja::findOrFail(Auth::user()->satuan_kerja_id);
            $pegawais = Pegawai::whereHas('unit_kerja', function ($query) {
                $query->where('satuan_kerja_id', '=', Auth::user()->satuan_kerja_id);
            })->whereNull('nik')->paginate($pagination);
        } else {
            $usulans = Usulan::where('status', true)->orderBy('satuan_kerja_id')->orderBy('updated_at', 'desc')->paginate($pagination);
            $pegawais = Pegawai::paginate($pagination);
            $kouta = SatuanKerja::all();
        }
        //dd($dpa->count());
        return view('usulan.index', ['usulans' => $usulans, 'pegawai' => $pegawais, 'kouta' => $kouta])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periode = Periode::orderBy('id', 'desc')->first();
        $satuan_kerjas = SatuanKerja::all();
        return view('usulan.create', ['periode' => $periode, 'satuan_kerjas' => $satuan_kerjas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'nomor_agenda' => 'required',
            'perihal' => 'required',
        ];
        $messages = [
            'required' => ':attribute harus diisi...!',
        ];
        $customAttributes = [
            'nomor_agenda' => 'Nomor Agenda Usulan',
        ];
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        if ($validator->fails())
        {
            return redirect()->route('usulan.create')->withErrors($validator)->withInput();
        } else {
            $usulan = new Usulan;

            $usulan->satuan_kerja_id = $request->satuan_kerja;
            $usulan->jenis_kebutuhan = $request->jenis_kebutuhan;
            $usulan->nomor_agenda = $request->nomor_agenda;
            $usulan->perihal = $request->perihal;
            $usulan->tanggal = $request->tanggal;
            $usulan->periode_id = $request->periode_id;

            $usulan->save();

            $request->session()->flash("message", "Usulan berhasil dibuat!");
            return redirect()->route('usulan.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usulan  $usulan
     */
    public function show(Usulan $usulan)
    {
        $data_usulan = Usulan::find($usulan->id);
        return view('usulan.show', ['usulans' => $data_usulan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usulan  $usulan
     */
    public function edit(Usulan $usulan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usulan  $usulan
     */
    public function update(Request $request, Usulan $usulan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usulan  $usulan
     */
    public function destroy(Usulan $usulan)
    {
        //
    }

    public function pegawai(Usulan $usulan)
    {
        if(Auth::user()->satuan_kerja_id == 5 or Auth::user()->satuan_kerja_id == 32 or Auth::user()->satuan_kerja_id == 33)
        {
            $pegawais = Pegawai::whereHas('unit_kerja', function ($query) {
                $query->where('satuan_kerja_id', '=', Auth::user()->satuan_kerja_id);
            })->where('status', '=', $usulan->jenis_kebutuhan)->where('status_usulan', 0)->where('vaksin_kedua', 1)->whereNotNull('spkk')->orderBy('nama')->get();
        } else {
            $pegawais = Pegawai::whereHas('unit_kerja', function ($query) {
                $query->where('satuan_kerja_id', '=', Auth::user()->satuan_kerja_id);
            })->where('status', '=', $usulan->jenis_kebutuhan)->where('status_usulan', 0)->where('vaksin_kedua', 1)->whereNotNull('spkk')->orderBy('nama')->get();
        }

        //$pegawais->whereNotIn('id', DB::table('absensi_2021')->select('pegawai_id')->where('ketidakhadiran', '<', 29)->get()->toArray())->get();
        //dd($pegawais);
        //DB::table('user')->select('id','name')->whereNotIn('id', DB::table('curses')->select('id_user')->where('id_user', '=', $id)->get()->toArray())->get();
        return view('usulan.pegawai', ['pegawais' => $pegawais, 'usulan' => $usulan->id]);
    }

    public function pegawai_store(Request $request)
    {
        try {
            $usulan_id = $request->usulan_id;
            $pegawai_id = $request->pegawai;
            $satuan_kerja = SatuanKerja::findOrFail(Auth::user()->satuan_kerja_id);

            $sisa = $satuan_kerja->sisa;
            $jumlah_usulan = count($pegawai_id);
            if($jumlah_usulan > $sisa)
            {
                $request->session()->flash("error", "Gagal...!!!Pegawai yang diusulkan melebihi kouta!");
                return redirect()->route('usulan.index');
            } else {
                $satuan_kerja->sisa = $sisa - $jumlah_usulan;
                $satuan_kerja->update();
                for ($i = 0; $i < count($pegawai_id); $i++) {
                    $tim_atlet = new PegawaiUsulan();
                    $tim_atlet->usulan_id = $usulan_id;
                    $tim_atlet->pegawai_id = $pegawai_id[$i];
                    $pegawai = Pegawai::findOrFail($pegawai_id[$i]);
                    $pegawai->status_usulan = 1;
                    $pegawai->update();
                    $tim_atlet->save();
                }
                $request->session()->flash("message", "Pegawai berhasil diusulkan!");
                return redirect()->route('usulan.index');
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return redirect()->route('usulan.index')->withErrors();
            } else {
                return redirect()->route('usulan.index')->withErrors();
            }
        }
    }

    public function verifikasi(Usulan $usulan)
    {

        $data = Usulan::findOrFail($usulan->id);

        if(Auth::user()->can('verifikasi bkpsdm'))
        {
            $dpa_id = $data->satuan_kerja_id;
            $data_dpa = DokumenPelaksanaanAnggaran::where('satuan_kerja_id', $dpa_id)->first();
            $data_usulan = $data->pegawai()->wherePivot('status_gampong', '=', '1')->get();
            $return_data = ['pegawais' => $data_usulan, 'usulan' => $usulan->id, 'dpa' => $data_dpa];
        } elseif (Auth::user()->can('verifikasi pemda')) {
            //$dpa_id = $data->satuan_kerja_id;
            //$data_dpa = DokumenPelaksanaanAnggaran::find($dpa_id);
            $data_usulan = $data->pegawai()->wherePivot('status_bkpsdm', '=', '1')->get();
            $return_data = ['pegawais' => $data_usulan, 'usulan' => $usulan->id];
        } else {
            //$dpa_id = $data->satuan_kerja_id;
            //$data_dpa = DokumenPelaksanaanAnggaran::find($dpa_id);
            $data_usulan = $data->pegawai()->get();
            $return_data = ['pegawais' => $data_usulan, 'usulan' => $usulan->id];
        }

        //dd($data_dpa);
        return view('usulan.verifikasi', $return_data);
    }

    public function verifikasi_store(Request $request)
    {
        $usulan_id = $request->usulan_id;
        $pegawai_id = $request->pegawai;

        if(Auth::user()->can('verifikasi gampong'))
        {
            $keterangan_gampong = $request->keterangan;
            if (!empty($keterangan_gampong))
            {
                Usulan::find($usulan_id)->pegawai()->updateExistingPivot($pegawai_id, ['status_gampong' => 0, 'keterangan_gampong' => $keterangan_gampong]);
                $request->session()->flash("message", "Verifikasi Pegawai oleh DPMG berhasil!");
                return redirect()->route('usulan.index');
            } else {
                Usulan::find($usulan_id)->pegawai()->updateExistingPivot($pegawai_id, ['status_gampong' => 1]);
                $request->session()->flash("message", "Verifikasi Pegawai oleh DPMG berhasil!");
                return redirect()->route('usulan.index');
            }
        } else if(Auth::user()->can('verifikasi sosial')) {
            $keterangan_sosial = $request->keterangan;
            if (!empty($keterangan_sosial))
            {
                Usulan::find($usulan_id)->pegawai()->updateExistingPivot($pegawai_id, ['status_sosial' => 0, 'keterangan_sosial' => $keterangan_sosial]);
                $request->session()->flash("message", "Verifikasi Pegawai oleh Dinas Sosial berhasil!");
                return redirect()->route('usulan.index');
            } else {
                Usulan::find($usulan_id)->pegawai()->updateExistingPivot($pegawai_id, ['status_sosial' => 1]);
                $request->session()->flash("message", "Verifikasi Pegawai oleh Dinas Sosial berhasil!");
                return redirect()->route('usulan.index');
            }
        } else if(Auth::user()->can('verifikasi bkpsdm')) {
            $keterangan_bkpsdm = $request->keterangan;
            if (!empty($keterangan_bkpsdm))
            {
                Usulan::find($usulan_id)->pegawai()->updateExistingPivot($pegawai_id, ['status_bkpsdm' => 0, 'keterangan_bkpsdm' => $keterangan_bkpsdm]);
                $request->session()->flash("message", "Verifikasi Pegawai oleh BKPSDM berhasil!");
                return redirect()->route('usulan.index');
            } else {
                Usulan::find($usulan_id)->pegawai()->updateExistingPivot($pegawai_id, ['status_bkpsdm' => 1]);
                $request->session()->flash("message", "Verifikasi Pegawai oleh BKPSDM berhasil!");
                return redirect()->route('usulan.index');
            }
        } else {
            $keterangan_pemda = $request->keterangan;
            if (!empty($keterangan_pemda))
            {
                Usulan::find($usulan_id)->pegawai()->updateExistingPivot($pegawai_id, ['status_pemda' => 0, 'keterangan_pemda' => $keterangan_pemda]);
                $request->session()->flash("message", "Verifikasi Pegawai oleh SEKDAKAB berhasil!");
                return redirect()->route('usulan.index');
            } else {
                Usulan::find($usulan_id)->pegawai()->updateExistingPivot($pegawai_id, ['status_pemda' => 1]);
                $request->session()->flash("message", "Verifikasi Pegawai oleh SEKDAKAB berhasil!");
                return redirect()->route('usulan.index');
            }
        }
    }

    public function pertek(Usulan $usulan)
    {
        $data = Usulan::findOrFail($usulan->id);
        $status_pemda = $data->pegawai()->wherePivot('status_pemda', '=', '1')->get();
        //dd($status_pemda->count());
        return view('usulan.pertek', ['usulans' => $data, 'status_pemda' => $status_pemda]);
    }

    public function pertek_store(Request $request, Usulan $usulan)
    {
        $usulan->nomor_pertek = $request->nomor_pertek;
        $usulan->tanggal_pertek = $request->tanggal_pertek;

        $usulan->update();
        $request->session()->flash("message", "Pertimbangan Teknik berhasil diperbarui!");
        return redirect()->route('usulan.index');
    }

    public function print(Usulan $usulan)
    {
        // retreive all records from db
        $data_usulan = Usulan::findOrFail($usulan->id);

        if(Auth::user()->can('verifikasi gampong'))
        {
            $usulan_46 = $data_usulan->pegawai()->wherePivot('status_gampong', '=', '0')->get();
            $usulan_12 = $data_usulan->pegawai()->wherePivot('status_gampong', '=', '1')->get();
        } elseif (Auth::user()->can('verifikasi bkpsdm')) {
            $usulan_46 = $data_usulan->pegawai()->wherePivot('status_gampong', '=', '0')->get();
            $usulan_12 = $data_usulan->pegawai()->wherePivot('status_bkpsdm', '=', '1')->get();
        } elseif (Auth::user()->can('verifikasi pemda')) {
            $usulan_46 = $data_usulan->pegawai()->wherePivot('status_gampong', '=', '0')->get();
            $usulan_12 = $data_usulan->pegawai()->wherePivot('status_pemda', '=', '1')->get();
        } else {
            $usulan_12 = $data_usulan->pegawai;
            $usulan_46 = $data_usulan->pegawai()->wherePivot('status_sosial', '=', '0')->get();
        }

        $satuan_kerja = SatuanKerja::find($data_usulan->satuan_kerja_id);
        $verif = Auth::user()->name;

        if(Auth::user()->can('verifikasi bkpsdm'))
        {
            $pdf = PDF::loadView('usulan.print_bkpsdm', ['data46s' => $usulan_46, 'data12s' => $usulan_12, 'satuan_kerja' => $satuan_kerja, 'verif' => $verif])->setPaper('legal', 'landscape');
            // open PDF file in new tab
            return $pdf->stream();
        } else {
            // share data to view
            $pdf = PDF::loadView('usulan.print', ['data46s' => $usulan_46, 'data12s' => $usulan_12, 'satuan_kerja' => $satuan_kerja, 'verif' => $verif])->setPaper('legal', 'landscape');

            // open PDF file in new tab
            return $pdf->stream();
        }
    }

    public function print_sk(Usulan $usulan)
    {
        $data = Usulan::findOrFail($usulan->id);
        if(Auth::user()->satuan_kerja_id == $data->satuan_kerja_id || Auth::user()->hasRole('Admin')) {
            $qrcode = base64_encode(QrCode::format('svg')
                        //->merge('https://pdpk.acehtimurkab.go.id/assets/images/favicon.png', 0.5, true)
                        ->size(100)
                        ->errorCorrection('H')
                        ->generate(url()
                        ->full()));
            $data_pdpk = $data->pegawai()->wherePivot('status_pemda', '=', '1')->orderBy('nama')->get();
            $satuan_kerja = SatuanKerja::find($data->satuan_kerja_id);
            $pdf = PDF::loadView('usulan.print_sk', ['satuan_kerja' => $satuan_kerja, 'data_pdpk' => $data_pdpk, 'qrcode' => $qrcode])->setPaper('legal', 'landscape');
            return $pdf->stream();
        } else {
            return redirect()->route('home');
        }
    }
}
