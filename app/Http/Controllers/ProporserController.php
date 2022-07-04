<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProporserRequest;
use Illuminate\Http\Request;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Income;
use App\Models\Proporser;

class ProporserController extends Controller
{
    public function index()
    {
        $rts = Rt::all();
        $rws = Rw::all();
        $incomes = Income::all();
        return view('proporser.index', compact('rts', 'rws', 'incomes'));
    }

    public function store(ProporserRequest $request)
    {
        try {
            if ($request->has('photo')) {
                $photo = $request->file('photo')->store('photos');
            }

            Proporser::create([
                'rt_id' => $request->rt,
                'rw_id' => $request->rw,
                'income_id' => $request->income,
                'nik' => $request->nik,
                'kk' => $request->kk,
                'name' => $request->name,
                'province' => $request->province,
                'regency' => $request->regency,
                'district' => $request->district,
                'village' => $request->village,
                'address' => $request->address,
                'phone' => $request->phone,
                'photo' => $photo,
                'status' => 'pending',
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            session()->flash('success', 'Berhasil tambah data pengajuan bantuan');
            return redirect()->route('proporse.index');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }
}
