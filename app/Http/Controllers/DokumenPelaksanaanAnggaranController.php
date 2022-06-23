<?php

namespace App\Http\Controllers;

use App\Models\DokumenPelaksanaanAnggaran;
use App\Models\SatuanKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DokumenPelaksanaanAnggaranController extends Controller
{
    public function index(Request $request, SatuanKerja $satuankerja)
    {
        $pagination = 15;
        if (Auth::user()->satuan_kerja_id) {
            $dpas = DokumenPelaksanaanAnggaran::where('satuan_kerja_id', '=', Auth::user()->satuan_kerja_id)->orderBy('status')->paginate($pagination);
        } else {
            $dpas = DokumenPelaksanaanAnggaran::where('status', '<>', 2)->orderBy('updated_at', 'desc')->paginate($pagination);
        }
        return view('dpa.index', ['dpas' => $dpas])->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function create()
    {
        return view('dpa.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'nomor_dpa' => 'required',
            'nomor_rekening' => 'required',
            'uraian' => 'required',
            'sekolah' => 'required|integer',
            'akademi' => 'required|integer',
            'sarjana' => 'required|integer',
            'file_dpa' => 'required|mimes:pdf',
        ];
        $messages = [
            'required' => ':attribute wajib diisi...!',
            'size' => ':attribute tidak lebih dari :size',
            'integer' => ':attribute harus berupa angka!',
        ];
        $customAttributes = [
            'nomor_dpa' => 'Nomor DPA',
            'nomor_rekening' => 'Nomor Rekening',
            'sekolah' => 'Kouta SD/SMP/SMA/SEDERAJAT',
            'akademi' => 'Kouta D-I/D-II/D-III',
            'sarjana' => 'Kouta D-IV/S-1/S-2/S-3',
            'file_dpa' => 'File DPA',
        ];
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return redirect()->route('dpa.create')->withErrors($validator)->withInput();
        } else {
            $dpa = new DokumenPelaksanaanAnggaran;
            
            $dpa->periode_id = 1;
            $dpa->nomor_dpa = $request->nomor_dpa;
            $dpa->nomor_rekening = $request->nomor_rekening;
            $dpa->uraian = strtolower($request->uraian);
            $dpa->kouta_sekolah = $request->sekolah;
            $dpa->kouta_akademi = $request->akademi;
            $dpa->kouta_sarjana = $request->sarjana;
            $dpa->status = false;
            $dpa->satuan_kerja_id = Auth::user()->satuan_kerja_id;

            if ($request->hasFile("file_dpa")) {
                $file_dpa = $request->file_dpa;
                $fn_file_dpa = $dpa->satuan_kerja_id . "_" . time() . "." . $file_dpa->getClientOriginalExtension();
                $file_dpa->move(public_path('dpa'), $fn_file_dpa);
                $dpa->file_dpa = $fn_file_dpa;
            }

            $dpa->save();
            
            $satuan_kerja->kouta = $request->sekolah + $request->akademi + $request->sarjana;
            
            $satuan_kerja->update();

            $request->session()->flash("message", "DPA berhasil disimpan!");
            return redirect()->route('dpa.index');
        }
    }

    public function show(DokumenPelaksanaanAnggaran $dpa)
    {
        $data_dpa = DokumenPelaksanaanAnggaran::find($dpa->id);
        return view('dpa.show', ['dpa' => $data_dpa]);
    }

    public function update(Request $request, DokumenPelaksanaanAnggaran $dpa)
    {
        $data = $request->all();

        $rules = [
            'sekolah' => 'required|integer',
            'akademi' => 'required|integer',
            'sarjana' => 'required|integer',
        ];
        $messages = [
            'required' => ':attribute wajib diisi...!',
            'integer' => ':attribute harus dalam bentuk angka!',
        ];
        $customAttributes = [
            'sekolah' => 'Kouta SD/SMP/SMA/Sederajat',
            'akademi' => 'Kouta DI/DII/DIII/DIV',
            'sarjana' => 'Kouta S-1/S-2/S-3',
        ];
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return redirect()->route('dpa.show', $dpa->id)->withErrors($validator)->withInput();
        } else {

            $dpa->periode_id = 1;
            $dpa->kouta_sekolah = $request->sekolah;
            $dpa->kouta_akademi = $request->akademi;
            $dpa->kouta_sarjana = $request->sarjana;
            $dpa->status = $request->status_dpa;

            $dpa->update();

            $request->session()->flash("message", "DPA berhasil disimpan!");
            return redirect()->route('dpa.index');
        }
    }
}
