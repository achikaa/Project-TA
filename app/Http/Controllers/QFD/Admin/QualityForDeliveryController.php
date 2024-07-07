<?php

namespace App\Http\Controllers\QFD\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QFD\Bapi;
use App\Models\QFD\DetailAttendance;
// use App\Http\Controllers\QFD\Admin\User;
use App\Models\QFD\QualityForDelivery;
use App\Models\QFD\ManagementEndCustomer;
use App\Models\QFD\DetailMeetingQFD;
use App\Models\QFD\DetailSpeaker;
use App\Models\Table\Satria\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class QualityForDeliveryController extends Controller
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
    public function new()
    {
        // $meeting = QualityForDelivery::where('flag', null)->get();
        // $meeting = QualityForDelivery::all();
        $po_interco = Bapi::select('PONUM', 'PRODUCTDESC')
        ->whereNotIn('PONUM', function($query) {
            $query->select('po_interco')
                ->from('trx_qfd');
        })
        ->get();

        $user = User::select('email','name')->get(); 
        $location = Http::withHeaders([
            'Authorization' => '44377|z2hXaICazxwpBhXTbHDdFqf64zRRRLDqJtqz6cSp',
        ])->get( 'https://satria-apps.patria.co.id/satria-api-man/public/api/qrgad-ruangans-list' );
        $data = json_decode($location, true);
       
        
        $link_new = 'quality-for-delivery';
        $link_onGoing = 'quality-for-delivery-ongoing';
        $link_finish  = 'quality-for-delivery-finish';
        
        //start card new
            //update 16-05-2024 perubahan multiple product
            $new = QualityForDelivery::select('trx_qfd.no_qfd', 'detail_meeting_qfd.id', 'trx_qfd.customer', 'trx_qfd.end_customer', 'trx_qfd.projectName', 'detail_meeting_qfd.created_at', 'trx_qfd.po_interco', 'trx_qfd.reqDelivery', 'trx_qfd.product_no', 'trx_qfd.id')
            ->join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')
            ->where('detail_meeting_qfd.meeting_ke', '1')
            ->whereNull('detail_meeting_qfd.updated_by')
            ->whereIn('trx_qfd.id', function($query) {
                $query->select(DB::raw('MAX(trx_qfd.id)'))
                    ->from('trx_qfd')
                    ->join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')
                    ->where('detail_meeting_qfd.meeting_ke', '1')
                    ->whereNull('detail_meeting_qfd.updated_by')
                    ->groupBy('trx_qfd.po_interco');
            })
            ->orderBy('detail_meeting_qfd.created_at', 'DESC')
            ->get();
            
            $po = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')
            ->select('detail_meeting_qfd.id','trx_qfd.po_interco','trx_qfd.reqDelivery')
            ->where('detail_meeting_qfd.meeting_ke', '1')
            ->where('detail_meeting_qfd.updated_by', NULL)
            ->orderBy('detail_meeting_qfd.created_at', 'DESC')
            ->get();

            $countnew = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')->where('detail_meeting_qfd.meeting_ke', '1')->where('detail_meeting_qfd.status', 'Open')->where('detail_meeting_qfd.updated_by', NULL)->count();

            $countfinish = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')->where('detail_meeting_qfd.status', 'Close')->count();

            $countongoing = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')
            ->where(function($query) {
                $query->where('detail_meeting_qfd.meeting_ke', 1)
                ->where('detail_meeting_qfd.status', 'Open')
                    ->whereNotNull('detail_meeting_qfd.updated_by');
            })
            ->orWhere(function($query) {
                $query->where('detail_meeting_qfd.meeting_ke', '>', 1)
                ->where('detail_meeting_qfd.status', 'Open');
            })
            ->count();

        // finish card new
        return view('qfd/quality-for-delivery/index', compact('po_interco','user','data','link_new','link_onGoing','link_finish','new','po','countnew', 'countfinish', 'countongoing'));

    }
    // sampe sini

    public function ongoing(){
        // start card ongoing

        $link_new = 'quality-for-delivery';
        $link_onGoing = 'quality-for-delivery-ongoing';
        $link_finish  = 'quality-for-delivery-finish';
            // update 16-05-2024 perubahan multiple product
            $po_interco = Bapi::select('PONUM','PRODUCTDESC')->get();
            $user = User::select('email','name')->get(); 
            $ongoing = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')
            ->select('trx_qfd.id','trx_qfd.po_interco','trx_qfd.no_qfd','trx_qfd.customer','trx_qfd.ProjectName','trx_qfd.reqDelivery','trx_qfd.end_customer','detail_meeting_qfd.meeting_ke','trx_qfd.product_no','trx_qfd.product_desc')
            ->where(function($query) {
                $query->where('detail_meeting_qfd.meeting_ke', 1)
                    ->where('detail_meeting_qfd.status','Open')
                    ->whereNotNull('detail_meeting_qfd.updated_by');
            })
            ->orWhere(function($query) {
                $query->where('detail_meeting_qfd.meeting_ke', '>', 1)
                        ->where('detail_meeting_qfd.status','Open')
                        ->whereNull('detail_meeting_qfd.updated_by');
            })
            // ->groupBy('trx_qfd.id')
            // ->groupBy('trx_qfd.id', 'trx_qfd.po_interco', 'trx_qfd.no_qfd', 'trx_qfd.customer', 'trx_qfd.ProjectName', 'trx_qfd.reqDelivery', 'trx_qfd.end_customer', 'detail_meeting_qfd.meeting_ke', 'trx_qfd.product_no', 'trx_qfd.product_desc')
            ->orderBy('detail_meeting_qfd.created_at', 'DESC')
            ->get();

            $noqfd = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')
            ->select('trx_qfd.no_qfd','trx_qfd.po_interco','trx_qfd.product_no')
            ->distinct()
            ->where(function($query) {
                $query->where('detail_meeting_qfd.meeting_ke', 1)
                    ->whereNotNull('detail_meeting_qfd.updated_by');
            })
            ->orWhere(function($query) {
                $query->where('detail_meeting_qfd.meeting_ke', '>', 1)
                    ->whereNull('detail_meeting_qfd.updated_by');
            })
            // ->groupBy('trx_qfd.id')
            ->get();
            // dd($noqfd );

            $countnew = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')->where('detail_meeting_qfd.meeting_ke', '1')->where('detail_meeting_qfd.status', 'Open')->where('detail_meeting_qfd.updated_by', NULL)->count();

            $countfinish = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')->where('detail_meeting_qfd.status', 'Close')->count();

            $countongoing = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')
            ->where(function($query) {
                $query->where('detail_meeting_qfd.meeting_ke', 1)
                ->where('detail_meeting_qfd.status', 'Open')
                    ->whereNotNull('detail_meeting_qfd.updated_by');
            })
            ->orWhere(function($query) {
                $query->where('detail_meeting_qfd.meeting_ke', '>', 1)
                ->where('detail_meeting_qfd.status', 'Open');
            })
            ->count();
        //finish card ongoing
        return view('qfd.quality-for-delivery.onGoing', compact('ongoing', 'noqfd', 'countongoing', 'po_interco', 'user','link_new','link_onGoing','link_finish','countnew', 'countfinish'));

        // return view('qfd/quality-for-delivery/index', compact('po_interco','user','data','link_new','link_onGoing','link_finish','ongoing','noqfd', 'countongoing'));
    }

    public function finish(){
        //start card finish
        $link_new = 'quality-for-delivery';
        $link_onGoing = 'quality-for-delivery-ongoing';
        $link_finish  = 'quality-for-delivery-finish';
            // update 16-05-2024 perubahan multiple product
            $finish = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')
            ->select('trx_qfd.po_interco','trx_qfd.no_qfd','trx_qfd.customer','trx_qfd.ProjectName','trx_qfd.reqDelivery','trx_qfd.end_customer','detail_meeting_qfd.meeting_ke','trx_qfd.product_no','trx_qfd.product_desc')
            ->where('detail_meeting_qfd.status', 'Close')
            // ->groupBy('trx_qfd.no_qfd')
            ->orderBy('detail_meeting_qfd.created_at', 'DESC')->get();
            $countfinish = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')->where('detail_meeting_qfd.status', 'Close')->count();

            $countnew = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')->where('detail_meeting_qfd.meeting_ke', '1')->where('detail_meeting_qfd.status', 'Open')->where('detail_meeting_qfd.updated_by', NULL)->count();

            $countongoing = QualityForDelivery::join('detail_meeting_qfd', 'trx_qfd.id', '=', 'detail_meeting_qfd.idQfd')
            ->where(function($query) {
                $query->where('detail_meeting_qfd.meeting_ke', 1)
                ->where('detail_meeting_qfd.status', 'Open')
                    ->whereNotNull('detail_meeting_qfd.updated_by');
            })
            ->orWhere(function($query) {
                $query->where('detail_meeting_qfd.meeting_ke', '>', 1)
                ->where('detail_meeting_qfd.status', 'Open');
            })
            ->count();

            return view('qfd.quality-for-delivery.finish', compact('finish', 'countfinish','link_new','link_onGoing','link_finish', 'countnew', 'countongoing'));

        //end card finish
    }

    public function getCustomer(Request $request)
    {
        $po_interco = $request->input('po');
        $product = $request->input('desc');

    $customer = Bapi::select( 'PONUM','PRODUCT','PRODUCTDESC','QTY','REQDELIVDATPO','ENDCUSTNAME','CUSTNAME', 'UOM', 'MATGROUP', 'ENDCUSTPO')->where('PONUM', $po_interco)->where('PRODUCTDESC',$product)->get();
    $data = json_decode($customer);

    return response()->json($data);
        // $customer = QualityForDelivery::select('Customer')->where('po_interco',$request->customer)->get();
        // $data = json_decode($customer);
        // return $data;
    }

    public function store(Request $request)
    { 
        // Pisahkan nilai no_interco dengan tanda koma
        $intercoParts = explode(',', $request->po_interco);
        $noInterco = $intercoParts[0];
        // dd( $intercoParts,$noInterco);
        $group_product = $request->prodnum;
        $response = Http::withHeaders([
            'Authorization' => '44377|z2hXaICazxwpBhXTbHDdFqf64zRRRLDqJtqz6cSp'
            ])->get('https://satria-apps.patria.co.id/satria-api-man/public/api/ccr-group-product-list?productNumber='.$group_product);
        $data = $response->json();
        // dd($data['data'][0]['group_product']);

        // $qty = $request->quantity;
        $qty = explode(' ', $request->quantity);
        $quantity = isset($qty[0]) ? $qty[0] : 0;
        $uom = isset($qty[1]) ? $qty[1] : '';   
        // $quantity = $qty[0];
        // $uom = $qty[1];
// dd($qty,$quantity,$uom);
        // Pisahkan nilai customer
        $cs = explode(' - ',$request->customer);
        $cus = isset($cs[0]) ? $cs[0] : '';
        $endcus = isset($cs[1]) ? $cs[1] : ''; 
        // $cus = $cs[0];
        // $endcus = $cs[1];
        
        $date = Carbon::now()->format('dmy');
        $customer = ManagementEndCustomer::select('customer_desc', 'alias')->get()->toArray();
        $initial = [];
        foreach($customer as $endCustomer){
            if ($endCustomer['customer_desc'] == $endcus ){
                $initial = $endCustomer['alias'];
                }
                }
         
        $urutan = QualityForDelivery::count();
        // dd($request->all(),$date, $initial, $urutan);

        $reqDelivery = Carbon::createFromFormat('d/m/Y H:i', $request->reqDelivery)->format('Y-m-d H:i:s');
// dd($request->projectName);

        $qfd = QualityForDelivery::create([
            'no_qfd' => $date.'/'.$initial.'/'.$urutan,
            'customer' =>$cus,
            'end_customer' =>$endcus,
            'projectName' =>$request->projectName,
            'customerpo' =>$request->customerpo,
            'created_by' =>Auth::user()->name,
            'po_interco' => $noInterco, // Masukkan bagian pertama dari po_interco
            'product_no' => $request->prodnum, 
            'product_desc' => $request->proddesk,
            'product_group' => $request->prodgroup,
            'reqDelivery' => $reqDelivery,
            'product_group_ima' => $data['data'][0]['group_product'], //ini diganti dari api baru
            'qty' => $quantity,
            'uom' => $uom,
        ]);

        // dd($qfd);
        $id = $qfd->id;
        // dd($request->all());
        $MeetingDate = Carbon::createFromFormat('d/m/Y H:i',$request->date)->format('Y-m-d H:i:s');
        // Hitung jumlah meeting_ke untuk idQfd tertentu
        $MeetingKe = DetailMeetingQFD::where('idQfd', $id)->count();

        // Buat entri baru dalam tabel DetailMeetingQFD
        $detailMeeting = DetailMeetingQFD::create([
        'idQfd' => $id,
        'MeetingOrganizer' => $request->meetingorganizer,
        'Location' => $request->location,
        'ReportedBy' => $request->reportedBy,
        'MeetingDate' => $MeetingDate,
        'meeting_ke' => $MeetingKe + 1,
        'status' => 'Open',
        'created_by' => Auth::user()->name,
        ]);

        $id_detail_meeting = $detailMeeting->id;
        for($i=0; $i < count($request->attendance); $i++){
            $attendance[] = [
               
                'id_detail_meeting' => $id_detail_meeting,
                'Name' =>$request->attendance[$i],
                'created_by' =>Auth::User()->name,
            ];
        }
        // dd($attendance);
        DetailAttendance::insert( $attendance);
        
// dd($request->all());
        for($i=0; $i < count($request->speaker); $i++){
            $speaker[] = [
       
            'id_detail_meeting' => $id_detail_meeting,
            'email_speaker' =>$request->speaker[$i],
            'created_by' => Auth::user()->name
            ];
        }
        DetailSpeaker::insert( $speaker);
        // dd($qfd,$detailMeeting,$attendance,$speaker);
        return redirect()->back()->with('success', 'Added!');
       
    }
    
    public function getMeetingCounts()
    {
        // Jalankan query SQL
        $results = DB::select(DB::raw("
        WITH labeled_meetings AS (
            SELECT 
                detail_meeting_qfd.meeting_ke, 
                detail_meeting_qfd.MeetingDate, 
                detail_meeting_qfd.Location, 
                detail_meeting_qfd.status, 
                detail_meeting_qfd.idQfd, 
                trx_qfd.po_interco,
                COUNT(*) AS count,
                CASE 
                    WHEN COUNT(*) = 1 THEN 'new'
                    ELSE 'on going'
                END AS label
            FROM 
                detail_meeting_qfd
            JOIN 
                trx_qfd 
            ON 
                detail_meeting_qfd.idQfd = trx_qfd.id
            GROUP BY 
                detail_meeting_qfd.meeting_ke,
                detail_meeting_qfd.MeetingDate,
                detail_meeting_qfd.Location,
                detail_meeting_qfd.status,
                detail_meeting_qfd.idQfd,
                trx_qfd.po_interco
        )
        SELECT 
            label,
            COUNT(*) AS total
        FROM 
            labeled_meetings
        GROUP BY 
            label;
    "));
    

        // Inisialisasi variabel untuk menghitung new dan on going
        $countNew = 0;
        $countOnGoing = 0;

        // Iterasi hasil query dan set nilai variabel
        foreach ($results as $result) {
            if ($result->label == 'new') {
                $countNew = $result->total;
            } elseif ($result->label == 'on going') {
                $countOnGoing = $result->total;
            }
        }

        // Menghasilkan URL berdasarkan nama rute
        $linkNewCard = route('new-meetings');
        $linkOnGoingCard = route('ongoing-meetings');
        $linkFinishCard = route('finish-meetings');

        // Mengembalikan data dalam format JSON
        return response()->json([
            'countnew' => $countNew,
            'countongoing' => $countOnGoing,
            'link_new_card' => $linkNewCard,
            'link_onGoing_card' => $linkOnGoingCard,
            'link_finish_card' => $linkFinishCard
        ]);
    }


    public function detailProjectnew ($id)
    {
        $detail = QualityForDelivery::join('detail_meeting_qfd', 'detail_meeting_qfd.idQfd', '=', 'trx_qfd.id')
        ->select('detail_meeting_qfd.meeting_ke', 'detail_meeting_qfd.MeetingDate', 'detail_meeting_qfd.Location', 'detail_meeting_qfd.status', 'detail_meeting_qfd.idQfd', 'trx_qfd.po_interco')
        ->where('trx_qfd.po_interco', $id) // Filter berdasarkan $id
        ->get();
        return view('qfd/quality-for-delivery/detailMeeting',compact('detail'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $pic = QualityForDelivery::findOrFail($id);
        $pic->update($request->all());
        $inisial_nama = QualityForDelivery::findOrFail($id);
        return json_encode($inisial_nama);
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
    
    public function destroy(Request $request)
    {
        $pic = QualityForDelivery::where('id', $request->id)->update([
            'flag' => 'X',
            'updated_by' => Auth::user()->name,
        ]);
    
        if ($pic) {
            return redirect()->back()->with('success', 'delete!');
        } else {
            return redirect()->back()->with('fail', 'fail!');
        }
    }
}
