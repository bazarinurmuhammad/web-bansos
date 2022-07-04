<?php

namespace App\Http\Controllers;

use App\Models\Proporser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RootController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $proporsers = Proporser::where('status', 'diterima')->with('rt')->with('rw')->get();

            return DataTables::of($proporsers)
            ->addIndexColumn()
            ->addColumn('rt', function(Proporser $proporser){
                return $proporser->rt->name;
            })
            ->addColumn('rw', function(Proporser $proporser){
                return $proporser->rw->name;
            })
            ->toJson();
        }
        
        $proporser = Proporser::where('status', 'diterima')->get();
        return view('landingPage', compact('proporser'));
    }
}
