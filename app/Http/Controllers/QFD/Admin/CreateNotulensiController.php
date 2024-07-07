<?php

namespace App\Http\Controllers\QFD\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QFD\DetailAttendance;
use App\Models\QFD\DetailMeetingQFD;
use App\Models\QFD\DetailSpeaker;
use App\Models\QFD\ManagementTruck;
use App\Models\QFD\DetailScheduleLine;
use App\Models\QFD\DetailScheduleLineProduksi;
use App\Models\QFD\DetailSchedulePbFinish;
use App\Models\QFD\DetailSpecification;
use App\Models\Table\Satria\User;
use App\Models\QFD\QualityForDelivery;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CreateNotulensiController extends Controller
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
    public function index($id)
    {
        $createNotulensi = QualityForDelivery::select('detail_meeting_qfd.id as idDetailMeeting','trx_qfd.po_interco', 'trx_qfd.projectName', 'trx_qfd.customerpo', 'trx_qfd.qty', 'trx_qfd.customer', 'trx_qfd.reqDelivery','detail_meeting_qfd.MeetingOrganizer', 'detail_meeting_qfd.Location', 'detail_meeting_qfd.ReportedBy', 'detail_meeting_qfd.MeetingDate', )
        ->join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')
        ->where('trx_qfd.po_interco', $id)
        ->first();

        $APIspec = Http::withHeaders([
            'Authorization' => '44377|z2hXaICazxwpBhXTbHDdFqf64zRRRLDqJtqz6cSp',
        ])->get('https://satria-apps.patria.co.id/satria-api-man/public/api/qfd-online-spec-qfd-list', [
            'po_interco' => $createNotulensi->po_interco
        ]);
        $api = json_decode($APIspec->body(), true);
        // dd($api);
        $spesifikasi = DetailSpecification::get();
        // $detailspeaker=DetailSpeaker::select('detail_speaker.id','detail_speaker.id_detail_meeting','detail_speaker.email_speaker')
        // ->where('detail_speaker.id_detail_meeting',$createNotulensi->id)
        // ->get();

        // // $user=User::select('users.name','users.email')
        // // ->where('users.email',$detailspeaker->email_speaker)
        // // ->get();

        // foreach ($detailspeaker as $speaker) {
        //     $user = User::select('users.name')
        //         ->where('users.email', $speaker->email_speaker)
        //         ->first(); // Use first() instead of get() to retrieve a single user record
        
        //     if ($user) {
        //         // Do something with the user data
        //         echo $user->name .",";
        //     }
        // }
       
        // $truck = ManagementTruck::select('truck')->distinct('truck')->get();
        // // $user = User::select('email','name')->get(); 
        // // print($user->email);
        // return view('qfd/quality-for-delivery/createNotulensi', compact('createNotulensi', 'truck', 'user'));
    $detailspeaker = DetailSpeaker::select('detail_speaker.id', 'detail_speaker.id_detail_meeting', 'detail_speaker.email_speaker')
    ->where('detail_speaker.id_detail_meeting', $createNotulensi->idDetailMeeting)
    ->get();

    $detailattendence = DetailAttendance::select('*')
        ->where('detail_attendance.id_detail_meeting', $createNotulensi->idDetailMeeting)
        ->get();
        
    $users = [];
    foreach ($detailspeaker as $speaker) {
        $user = User::select('users.name', 'users.email')
            ->where('users.email', $speaker->email_speaker)
            ->first();

        if ($user) {
            $users[] = $user;
        }
    }
    $attendences = [];

    foreach ($detailattendence as $attendence) {
        $userA = User::select('users.name', 'users.email')
            ->where('users.email', $attendence->Name)
            ->first();

        if ($userA) {
            $attendences[] = $userA;
        }
    }

    $truck = ManagementTruck::select('truck')->distinct('truck')->get();
    $MaterialNumber = DetailSpecification::select('MaterialNumber')->distinct('MaterialNumber')->get(); 

    return view('qfd/quality-for-delivery/createNotulensi', compact('api','createNotulensi', 'truck', 'users','attendences','spesifikasi','MaterialNumber', 'APIspec'));
        }

        public function showProject()
        {
            $project = QualityForDelivery::find(1)->get();
            return view('qfd/quality-for-delivery/detailMeeting',compact('project')); 
        }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'addnotulensi' => 'required|string',
            'meetingdate' => 'required|date',
            'speakers' => 'required|array',
            'attendance' => 'required|array',
            'warnadasar' => 'nullable|string',
            'pronum' => 'nullable|string',
            'truck' => 'required|string',
            'assy' => 'nullable|string',
        ], [
            'addnotulensi.required' => 'Notulensi wajib diisi',
            'meetingdate.required' => 'Meeting date wajib diisi',
            'meetingdate.date' => 'Meeting date harus berupa tanggal yang valid',
            'speakers.required' => 'Speakers wajib dipilih',
            'attendance.required' => 'Attendance wajib dipilih',
            'truck.required' => 'Truck wajib dipilih',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('fail', 'Validation failed!');
        }
    
        $data = $request->only(['addnotulensi', 'meetingdate', 'warnadasar', 'pronum', 'truck', 'assy']);
        $data['speakers'] = json_encode($request->speakers);
        $data['attendance'] = json_encode($request->attendance);
        $data = $request->only(['addnotulensi']);

        if (QualityForDelivery::create($data)) {
            return redirect()->back()->with('success', 'Added successfully!');
        } else {
            return redirect()->back()->with('fail', 'Failed to add data!');
        }
    }


    public function edit(Request $request)
    {
        $po = QualityForDelivery::all(); // Ambil semua data user
    
        if ($po->isEmpty()) {
            // Tangani kasus ketika tidak ada user ditemukan
            return response()->json(['error' => 'No users found'], 404);
        }
    
        $id = $request->id;
        $pic = QualityForDelivery::findOrFail($id);
    
        if (!$pic) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        $pic->update($request->all());
    
        // Ambil ulang data setelah update jika diperlukan
        $inisial_nama = QualityForDelivery::findOrFail($id);
    
        return json_encode($inisial_nama);
}

    public function detail(Request $request)
    {
        $id = $request->id;
        $detailMeeting = DetailMeetingQFD::findOrFail($id);
        return json_encode($detailMeeting);
    }

    public function update(Request $request)
    {
        $inisial_nama = QualityForDelivery::where('id', $request->id)->update([
            'inisial_nama' => $request->inisial_nama,
            'updated_by' => Auth::user()->name,
        ]);
    
        if ($inisial_nama) {
            return redirect()->back()->with('success', 'Update!');
        } else {
            return redirect()->back()->with('fail', 'fail!');
        }
     }

    //  public function destroy(Request $request)
    // {
    //     $truck = QualityForDelivery::where('id',$request->id)->update([
    //         'flag' =>'X',
    //         'updated_by'=> Auth::user()->name,
    //     ]);

    //     if ($truck){
    //         return redirect()->back()->with('success', 'delete!');
    //     }
    //     else {
    //         return redirect()->back()->with('fail', 'fail!');
    //     }
    //  }
  }
