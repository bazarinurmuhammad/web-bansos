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

class ReceiverController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $receivers = Proporser::where('status', 'diterima')->with('rt')->with('rw')->get();

            return DataTables::of($receivers)
            ->addIndexColumn()
            ->addColumn('rt', function(Proporser $receiver){
                return $receiver->rt->name;
            })
            ->addColumn('rw', function(Proporser $receiver){
                return $receiver->rw->name;
            })
            ->addColumn('income', function(Proporser $receiver){
                return $receiver->income->name;
            })
            ->addColumn('action', 'admin.receiver.dt-action')
            ->toJson();
        }

        return view('admin.receiver.index');
    }

    public function edit($id)
    {
        $receiver = Proporser::findOrFail($id);
        $rts = Rt::all();
        $rws = Rw::all();
        $incomes = Income::all();

        return view('admin.receiver.edit', compact('receiver', 'rts', 'rws', 'incomes'));
    }

    public function update(ProporserRequest $request, $id)
    {
        $receiver = Proporser::findOrFail($id);
        $photo = $receiver->photo;
        try {
            if ($request->has('photo')) {
                if (Storage::exists($receiver->photo)) {
                    Storage::delete($receiver->photo);
                }
                $photo = $request->file('photo')->store('photos');
            }

            $receiver->update([
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
            session()->flash('success', 'Berhasil update data penerimaan bantuan');
            return redirect()->route('manage-receiver.index');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return redirect()->back();

        }
    }

    public function destroy($id)
    {
        $receiver = Proporser::findOrFail($id);

        if ($receiver) {
            if (Storage::exists($receiver->photo)) {
                Storage::delete($receiver->photo);
            }

            $receiver->delete();

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
