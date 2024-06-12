<?php

namespace App\Http\Controllers\QFD\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QFD\ManagementTruck;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManagementTruckController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $truck = ManagementTruck::where('flag', null)->get();
        return view('qfd/management-truck/index',compact('truck')); 
    }

    public function store(Request $request)
    {
        // $valiasi = Validator::make($request->all(), [
        //     'truck' => 'required',
        // ], [
        //     'truck.required' => 'wajib diisi',
        // ]);
        // if ($valiasi->fails()) {
        //     // return redirect()->back()->with('fail', 'fail!'); 
        //     return redirect()->back()->with('fail', 'Validation failed!')->withErrors($valiasi);           
        //     // return response()->json(['errors' => $valiasi->errors()]);
        // } else {
        //     $data = [
        //         'truck' => $request->name,
        //     ];
        // }
        if ($truck = ManagementTruck::create($request->all())){
            return redirect()->back()->with('success','Added!');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $truck = ManagementTruck::findOrFail($id);
        return json_encode($truck);
    }

    public function update(Request $request)
    {
        $truck = ManagementTruck::where('id',$request->id)->update([
            'truck' =>$request->truck,
            'updated_by'=> Auth::user()->name,
        ]);
        if ($truck){
            return redirect()->back()->with('success', 'Update!');
        }
        else {
            return redirect()->back()->with('fail', 'fail!');
        }
     }

     public function destroy(Request $request)
    {
        $truck = ManagementTruck::where('id',$request->id)->update([
            'flag' =>'X',
            'updated_by'=> Auth::user()->name,
        ]);

        if ($truck){
            return redirect()->back()->with('success', 'delete!');
        }
        else {
            return redirect()->back()->with('fail', 'fail!');
        }
     }
  }
