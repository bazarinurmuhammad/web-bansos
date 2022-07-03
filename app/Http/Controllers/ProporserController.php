<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $request->validate([
            'rt' => ['required'],
            'rw' => ['required'],
            'income' => ['required'],
            'nik' => ['required'],
            'kk' => ['required'],
            'name' => ['required'],
            'province' => ['required'],
            'regency' => ['required'],
            'district' => ['required'],
            'village' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
            'photo' => ['required', 'image'],
            'latitude' => ['required'],
            'longitude' => ['required']
        ]);

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
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            session()->flash('success', 'Berhasil tambah data tempat kuliner');
            return redirect()->route('proporse.index');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return redirect()->back();

        }
    }
}
