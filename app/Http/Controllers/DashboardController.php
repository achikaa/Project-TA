<?php

namespace App\Http\Controllers;

use App\Models\QFD\DetailSchedule;
use App\Models\QFD\QualityForDelivery;
use Illuminate\Http\Request;

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
        $data = DetailSchedule::join('ms_proses', 'ms_proses.id', '=', 'detail_schedule.id_proses')
        ->join('detail_schedule as ds1', 'ms_proses.id', '=', 'ds1.id_proses')
        ->select('detail_schedule.*', 'ms_proses.*')
        ->take(3)
        ->get();

        // $data = DetailSchedule::all();
        // $data = DetailSchedule::join('detail_schedule', 'ms_proses.id', '=', 'detail_schedule.id_proses')
        // ->join('detail_schedule', 'ms_proses.id', '=', 'detail_schedule.id_proses' )
        // ->select('detail_schedule.*', 'ms_proses.*')
        // ->take(3)
        // ->get(); 

        return view('qfd/dashboard',['data' => $data]);

        

            // [
            //     'pro' => '7100005856',
            //     'due_date' => '16/04/2024',
            //     'part_number' => 'RB8024-A1000000',
            //     'quantity' => 1,
            //     'product' => 'WT-80KL KOMATSU HD785-7',
            //     'sn' => 'RB8024-2411114',
            //     'customer' => 'Plant Cikarang / Jakarta',
            //     'so' => '8440000408',
            //     'start_date' => '2024-04-15',
            //     'end_date' => '2024-04-15',
            //     'phase' => 'P',
            //     'activity' => 'A',
            // ],
            // ... other data entries
        

        // return view('dasboaard', ['data' => $data]);
        
    }
}

