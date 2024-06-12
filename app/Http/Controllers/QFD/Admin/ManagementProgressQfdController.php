<?php

namespace App\Http\Controllers\QFD\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QFD\ManagementProgressQFD;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManagementProgressQfdController extends Controller
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
        $proses = ManagementProgressQFD::where('flag', null)->get();
        return view('qfd/management-progress/index',compact('proses')); 
    }

    public function store(Request $request)
    {
        // $valiasi = Validator::make($request->all(), [
        //     'proses' => 'required',
        // ], [
        //     'proses.required' => 'wajib diisi',
        // ]);

        // if ($valiasi->fails()) {
        //     return response()->json(['errors' => $valiasi->errors()]);
        // } else {
        //     $data = [
        //         'proses' => $request->name,
        //         'created_by' => Auth::user()->id,
        //         'updated_by' => Auth::user()->id
        //     ];
        if ($proses = ManagementProgressQFD::create($request->all())){
            return redirect()->back()->with('success','Added!');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $proses = ManagementProgressQFD::findOrFail($id);
        return json_encode($proses);
    }

    public function update(Request $request)
    {
        $proses = ManagementProgressQFD::where('id',$request->id)->update([
            'proses' =>$request->proses,
            'updated_by'=> Auth::user()->name,
        ]);

        if ($proses){
            return redirect()->back()->with('success', 'Update!');
        }
        else {
            return redirect()->back()->with('fail', 'fail!');
        }
     }

     public function destroy(Request $request)
    {
        $proses = ManagementProgressQFD::where('id',$request->id)->update([
            'flag' =>'X',
            'updated_by'=> Auth::user()->name,
        ]);

        if ($proses){
            return redirect()->back()->with('success', 'delete!');
        }
        else {
            return redirect()->back()->with('fail', 'fail!');
        }
     }
  }
