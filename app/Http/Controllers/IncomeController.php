<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Income;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $incomes = Income::query();

            return DataTables::of($incomes)
                ->addIndexColumn()
                ->addColumn('action', 'income.dt-action')
                ->toJson();
        }

        return view('income.index');
    }

    public function create()
    {
        return view('income.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string']
        ]);

        Income::create([
            'name' => $request->name
        ]);

        return redirect()->route('income.index')->with('success', 'berhasil menambah pendapatan');
    }

    public function edit($id)
    {
        $income = Income::findOrFail($id);

        return view('income.edit', compact('income'));
    }

    public function update(Request $request, $id)
    {
        $income = Income::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string']
        ]);

       $income->update([
            'name' => $request->name
        ]);

        return redirect()->route('income.index')->with('success', 'berhasil update pendapatan');
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        if ($income->delete()) {
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
