<?php

namespace App\Http\Controllers;

use App\Models\SatuanKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerangkatDaerahController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 16;
        $perangkat_daerahs = SatuanKerja::paginate($paginate);
        return view('perangkatdaerah.index', ['perangkat_daerahs' => $perangkat_daerahs])->with('i', ($request->input('page', 1) - 1) * $paginate);
    }
    
    public function show(SatuanKerja $satuankerja)
    {
        return view('perangkatdaerah.show', ['satuan_kerja' => $satuankerja]);
    }
    
    public function edit(SatuanKerja $satuankerja)
    {
        return view('perangkatdaerah.edit', ['satuan_kerja' => $satuankerja]);
    }
    
    public function update(Request $request, SatuanKerja $satuankerja)
    {
        $data = $request->all();

        $rules = [
            'kouta' => 'integer',
            'jumlah_bulan' => 'integer',
        ];
        $messages = [
            'integer' => ':attribute harus dalam bentuk angka!',
        ];
        $customAttributes = [
            'kouta' => 'Kouta Formasi',
            'jumlah_bulan' => 'Jumlah Bulan yang Dibayar',
        ];
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            return redirect()->route('perangkat_daerah.edit', $satuankerja->id)->withErrors($validator)->withInput();
        } else {
            $satuankerja->update($data);

            $request->session()->flash("message", "Perangkat Daerah berhasil diperbarui!");
            return redirect()->route('perangkat_daerah.index');
        }
    }
}
