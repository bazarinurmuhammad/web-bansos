<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProporserRequest;
use App\Models\Income;
use App\Models\Proporser;
use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdminProporserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $proporsers = Proporser::where('status', 'pending')->with('rt')->with('rw')->get();

            return DataTables::of($proporsers)
            ->addIndexColumn()
            ->addColumn('rt', function(Proporser $proporser){
                return $proporser->rt->name;
            })
            ->addColumn('rw', function(Proporser $proporser){
                return $proporser->rw->name;
            })
            ->addColumn('income', function(Proporser $proporser){
                return $proporser->income->name;
            })
            ->addColumn('action', 'admin.proporser.dt-action')
            ->toJson();
        }

        return view('admin.proporser.index');
    }

    public function create()
    {
        $rts = Rt::all();
        $rws = Rw::all();
        $incomes = Income::all();

        return view('admin.proporser.create', compact('rts', 'rws', 'incomes'));
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
            return redirect()->route('manage-proporser.index');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $proporser = Proporser::findOrFail($id);
        $rts = Rt::all();
        $rws = Rw::all();
        $incomes = Income::all();

        return view('admin.proporser.edit', compact('proporser', 'rts', 'rws', 'incomes'));
    }

    public function update(ProporserRequest $request, $id)
    {
        $proporser = Proporser::findOrFail($id);
        $photo = $proporser->photo;
        try {
            if ($request->has('photo')) {
                if (Storage::exists($proporser->photo)) {
                    Storage::delete($proporser->photo);
                }
                $photo = $request->file('photo')->store('photos');
            }

            $proporser->update([
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
                'status' => $request->status,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            session()->flash('success', 'Berhasil update data pengajuan bantuan');
            return redirect()->route('manage-proporser.index');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return redirect()->back();

        }
    }

    public function destroy($id)
    {
        $proporser = Proporser::findOrFail($id);

        if ($proporser) {
            if (Storage::exists($proporser->photo)) {
                Storage::delete($proporser->photo);
            }

            $proporser->delete();

            session()->flash('error', 'Data dihapus');

            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }
}
