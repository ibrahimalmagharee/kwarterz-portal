<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Concat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ConcatController extends Controller
{
    // ConcatController   ------- concatUS
    public function index(Request $request){
        $concat= Concat::paginate(10);

        if ($request->ajax()) {

            return DataTables::of(Concat::query())
                ->make(true);
        }
        return view('admin.concat.index',compact('concat'));
    }
}
