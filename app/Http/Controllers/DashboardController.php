<?php

namespace App\Http\Controllers;

use App\Models\QFD\DetailScheduleLine;
use App\Models\QFD\DetailScheduleLineProduksi;
use App\Models\QFD\DetailSchedulePbFinish;

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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function yourFunction()
{
    // Ambil data pertama dari tabel detail_schedule_pb_finish
    $firstProcess = DetailSchedulePbFinish::first();

    // Cek apakah data ditemukan
    if ($firstProcess) {
        // Kirim data ke view
        return view('qfd.dashboard', ['nama_proses' => $firstProcess->nama_proses]);
    } else {
        // Tangani kasus jika tidak ada data
        return view('qfd.dashboard', ['nama_proses' => 'Data tidak ditemukan']);
    }
}
    public function getDetail($id)
    {
        $detail = DetailScheduleLine::find($id);
        return view('partials.tooltip-detail', compact('detail'));
    }
    
    public function index(Request $request)
    {
        
        $selectedMonth = $request->get('month', date('m'));
        $selectedYear = $request->get('year', date('Y'));

        // Fetch data based on the selected month and year
        // $detailScheduleLines = DetailScheduleLine::whereMonth('start_date', $selectedMonth)
        //     ->whereYear('start_date', $selectedYear)
        //     ->get();
        $detailScheduleLines = DetailScheduleLine::all();
        foreach ($detailScheduleLines as $line) {
            $events[] = [
                'title' => $line->nama_proses,
                'start' => $line->start_date,
                'end' => $line->finish_date,
                'description' => $line->deskripsi, // Menambah deskripsi
                'color' => '#ff9f89' // Warna untuk DetailScheduleLine
            ];
        }

        

        $detailScheduleLineProduksis = DetailScheduleLineProduksi::all();
        foreach ($detailScheduleLineProduksis as $lineProduksi) {
            $events[] = [
                'title' => $lineProduksi->nama_proses,
                'start' => $lineProduksi->start_date,
                'end' => $lineProduksi->finish_date,
                'description' => $lineProduksi->deskripsi, // Menambah deskripsi
                'color' => '#66bb6a' // Warna untuk DetailScheduleLineProduksi
            ];
        }

        // $detailSchedulePbFinishes = DetailSchedulePbFinish::whereMonth('start_date', $selectedMonth)
        //     ->whereYear('start_date', $selectedYear)
        //     ->get();

        $detailSchedulePbFinishes = DetailSchedulePbFinish::all();
        foreach ($detailSchedulePbFinishes as $pb) {
            $events[] = [
                'title' => $pb->nama_proses,
                'start' => $pb->start_date,
                'end' => $pb->finish_date,
                'description' => $pb->deskripsi, // Menambah deskripsi
                'color' => '#42a5f5' // Warna untuk DetailSchedulePbFinish
            ];
        }

        
        return view('qfd.dashboard', compact('selectedMonth', 'selectedYear', 'detailScheduleLines', 'detailScheduleLineProduksis', 'detailSchedulePbFinishes'));
    }
}