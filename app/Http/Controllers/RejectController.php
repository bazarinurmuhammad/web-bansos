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

class RejectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rejects = Proporser::where('status', 'ditolak')->with('rt')->with('rw')->get();

            return DataTables::of($rejects)
            ->addIndexColumn()
            ->addColumn('rt', function(Proporser $reject){
                return $reject->rt->name;
            })
            ->addColumn('rw', function(Proporser $reject){
                return $reject->rw->name;
            })
            ->addColumn('income', function(Proporser $reject){
                return $reject->income->name;
            })
            ->addColumn('action', 'admin.reject.dt-action')
            ->toJson();
        }

        return view('admin.reject.index');
    }

    public function edit($id)
    {
        $reject = Proporser::findOrFail($id);
        $rts = Rt::all();
        $rws = Rw::all();
        $incomes = Income::all();

        return view('admin.reject.edit', compact('reject', 'rts', 'rws', 'incomes'));
    }

    public function update(ProporserRequest $request, $id)
    {
        $reject = Proporser::findOrFail($id);
        $photo = $reject->photo;
        try {
            if ($request->has('photo')) {
                if (Storage::exists($reject->photo)) {
                    Storage::delete($reject->photo);
                }
                $photo = $request->file('photo')->store('photos');
            }

            $reject->update([
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
            session()->flash('success', 'Berhasil update data');
            return redirect()->route('manage-reject.index');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return redirect()->back();

        }
    }

    public function destroy($id)
    {
        $reject = Proporser::findOrFail($id);

        if ($reject) {
            if (Storage::exists($reject->photo)) {
                Storage::delete($reject->photo);
            }

            $reject->delete();

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
