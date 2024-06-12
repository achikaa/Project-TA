<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use App\Models\ErrorLogs;
use Exception;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function satriaLogin($username, $password) {
        
        $postdata=array(
        'email'=>$username,
        'password'=>$password,
        );
        $response = Http::withHeaders(['Authorization' => env('ENV_TOKEN'),])->post(env('ENV_SATRIA_URL').'sf-login',$postdata);
        $data = json_decode($response,true);
        // dd($data);
        return $data;
    }

    public static function menulistSatria($access_token)
    {
        $response = Http::withHeaders([
            'x-api-key' => '44377|z2hXaICazxwpBhXTbHDdFqf64zRRRLDqJtqz6cSp',
            'Authorization' => 'Bearer ' .$access_token
        ])->get(env('ENV_SATRIA_URL') .'satria-permission-menu-list');
        $data = json_decode($response, true);
        return $data['data'];
    }

    public function spec()
    {
        $response = Http::get('satria-apps.patria.co.id/satria-api-man/public/api/qfd-online-spec-qfd-list?po_interco=8440000190');
        $data = json_decode($response, true);
        return $data;
    }

    public static function ErrorLog($e)
    {
        try {
            $message = $e->getMessage();
            $code = $e->getCode();    
            $string = $e->__toString();   
            $create = ErrorLogs::create([
                'remote_addr'=>$_SERVER['REMOTE_ADDR'],
                'action'=>url()->current(),
                'code'=>$code,
                'message'=>$message,
                'ex_string'=>$string,
                'apps'=>Auth::user()->accessed_app,
                'created_by' => Auth::user()->email,
            ]);
        } catch (Exception $e) {
        }
    }
}
