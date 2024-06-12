<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request){
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $response = $this->satriaLogin($request->email, $request->password);
        if($response != null) {
            // return redirect()->route('alat');    
            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect()->route('home');
            } else {
                    // Create a new user
                    if (isset($response['data'])) {
                        $user = User::create([
                            'name' => $response['data']['name'] ?? $request->name,
                            'email' => $response['data']['email'] ?? $request->email,
                            'password' => Hash::make($request->password),
                            'access_token' => $response['access_token'] ?? $request->access_token,
                        ]); 
                        Auth::attempt($request->only('email', 'password'));
                        return redirect()->route('home');
                    } else {
                        // User data not found in the response, handle the error
                        return redirect()->back()->withInput()->withErrors(['error' => 'Invalid email or password.']);
                    }
            }
        }else{
            // API login failed, handle the error
            return redirect()->back()->withInput()->withErrors(['error' => 'API login failed.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');

    }
}
    
    //kalau sukses -> 
        //ngecek di db udah ada atau belum (di db user), kalau udah ada -> langsung login
        //kalau blm ada di db -> insert ke table user -> pake data dari response API (yang password aja)
    //else 
        // error