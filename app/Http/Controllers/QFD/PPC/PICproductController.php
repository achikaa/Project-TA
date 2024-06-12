<?php
namespace App\Http\Controllers\QFD\PPC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QFD\ManagementPicProduct;
use App\Models\QFD\GroupProduct; // Tambahkan model GroupProduct
use App\Models\Table\Satria\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PICproductController extends Controller
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
    public function index2()
    {
        $pic = ManagementPicProduct::whereNull('flag')->get();
        $user = User::get();
        $groupProducts = GroupProduct::select('group_product')->distinct('group_product')->get();
         // Ambil semua data Group Product
        return view('qfd/management-pic-product/index', compact('pic', 'groupProducts', 'user')); 
    }

    public function getEmail(Request $request)
    {
        $user = User::select('email')->where('name',$request->name)->get();
        $data = json_decode($user);
      
        return $data;
    }
    
    public function store(Request $request)
    {
        $pic = ManagementPicProduct::create([
            'name' => $request->name,
            'inisial_nama' => $request->initial,
            'group_product' => $request->gproduct,
            'email' => $request->email,
        ]);
        return redirect()->back()->with('success', 'Added!');
    }
    
    public function edit(Request $request)
    {
        $user = User::all(); // Ambil semua data user
    
        if ($user->isEmpty()) {
            // Tangani kasus ketika tidak ada user ditemukan
            return response()->json(['error' => 'No users found'], 404);
        }
    
        $id = $request->id;
        $pic = ManagementPicProduct::findOrFail($id);
    
        if (!$pic) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        $pic->update($request->all());
    
        // Ambil ulang data setelah update jika diperlukan
        $inisial_nama = ManagementPicProduct::findOrFail($id);
    
        return json_encode($inisial_nama);
    }
    
    
    public function update(Request $request, $id)
    {
        try{
            if($this->PermissionActionMenu('management-pic-product')->u = 1) {
                $inisial_nama = ManagementPicProduct::where('id', $request->id)->update([
                    'inisial_nama' => $request->inisial_nama,
                    'updated_by' => Auth::user()->name,
                ]);
                if ($inisial_nama) {
                    return redirect()->back()->with('success', 'Update!');
                }else {
                    return response()->json([
                        'message' => 'location tidak ditemukan',
                        'data' => null
                    ], 404);
                }
            }else{
                return response()->json([
                    'message' => 'Akses Ditolak!',
                    'data' => null
                ], 404);
                // return response()->with('err_message', 'Akses Ditolak!');
            }
        }catch (Exception $e){
            $this->ErrorLog($e);
            // return redirect()->back()->with('err_message', 'Error Request, Exception Error');
            return response()->json([
                'message' => 'Error Request',
                'data' => null
            ], 404);
        }
    }
    
    public function destroy(Request $request)
    {
        $pic = ManagementPicProduct::where('id', $request->id)->update([
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
