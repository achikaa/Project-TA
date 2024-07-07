<?php

namespace App\Http\Controllers\QFD\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QFD\ManagementEndCustomer;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManagementEndCustomerController extends Controller
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
        $customers = ManagementEndCustomer::where('flag', null)->get(); 
        return view('qfd/management-end-customer/index', ['customer' => $customers]);
        // // $proses = ManagementEndCustomer::where('flag', null)->get();
        // return view('qfd/management-end-customer/index',compact('customer')); 
    }

    public function store(Request $request)
    {
        if ($customer = ManagementEndCustomer::create($request->all())){
            return redirect()->back()->with('success','Added!');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $customer = ManagementEndCustomer::findOrFail($id);
        $customer->update($request->all());
        
        return json_encode($customer);
    }



        public function update(Request $request)
        {
            $customer = ManagementEndCustomer::where('id',$request->id)->update([
            'customer_code' => $request->customer_code,
            'customer_desc' => $request->customer_desc,
            'alias' => $request->alias,
            'title' => $request->title,
            'street' => $request->street,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'updated_by'=> Auth::user()->name,
            ]);
            
            // dd($request->all());
            Log::info('Request Data: ', $request->all());
            if ($customer){
                return redirect()->back()->with('success', 'Update!');
            }
            else {
                return redirect()->back()->with('fail', 'fail!');
            }
        }

     public function destroy(Request $request)
    {
        $customer = ManagementEndCustomer::where('id',$request->id)->update([
            'flag' =>'X',
            'updated_by'=> Auth::user()->name,
        ]);

        if ($customer){
            return redirect()->back()->with('success', 'delete!');
        }
        else {
            return redirect()->back()->with('fail', 'fail!');
        }
     }
  }
