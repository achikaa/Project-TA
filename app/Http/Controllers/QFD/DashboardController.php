<?php

namespace App\Http\Controllers\QFD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
        try{
            if($this->PermissionActionMenu('qfd-dashboard')->r==1){
                
                return view('qfd/dashboard');
            }else{
                return redirect()->back()->with('err_message', 'Akses Ditolak!');
            }  
        } catch (Exception $e) {    
            $this->ErrorLog($e);
            return redirect()->back()->with('err_message', 'Error Request, Exception Error ');
        }
    }

    
}
