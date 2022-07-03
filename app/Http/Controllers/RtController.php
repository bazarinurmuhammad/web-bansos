<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Rt;

class RtController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rts = Rt::query();

            return DataTables::of($rts)
                ->addIndexColumn()
                ->addColumn('action', 'rt.dt-action')
                ->toJson();
        }

        return view('rt.index');
    }

    public function create()
    {
        return view('rt.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        Rt::create([
            'name' => $request->name
        ]);

        return redirect()->route('rt.index')->with('success', 'berhasil menambah rt');
    }

    public function edit($id)
    {
        $rt = Rt::findOrFail($id);

        return view('rt.edit', compact('rt'));
    }

    public function update(Request $request, $id)
    {
        $rt = Rt::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string']
        ]);

       $rt->update([
            'name' => $request->name
        ]);

        return redirect()->route('rt.index')->with('success', 'berhasil update rt');
    }

    public function destroy($id)
    {
        $rt = Rt::findOrFail($id);
        if ($rt->delete()) {
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
