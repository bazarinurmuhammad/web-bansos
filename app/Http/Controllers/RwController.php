<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Rw;

class RwController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rws = Rw::query();

            return DataTables::of($rws)
                ->addIndexColumn()
                ->addColumn('action', 'rw.dt-action')
                ->toJson();
        }

        return view('rw.index');
    }

    public function create()
    {
        return view('rw.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        Rw::create([
            'name' => $request->name
        ]);

        return redirect()->route('rw.index')->with('success', 'berhasil menambah rw');
    }

    public function edit($id)
    {
        $rw = Rw::findOrFail($id);

        return view('rw.edit', compact('rw'));
    }

    public function update(Request $request, $id)
    {
        $rw = Rw::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string']
        ]);

       $rw->update([
            'name' => $request->name
        ]);

        return redirect()->route('rw.index')->with('success', 'berhasil update rw');
    }

    public function destroy($id)
    {
        $rw = Rw::findOrFail($id);
        if ($rw->delete()) {
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
