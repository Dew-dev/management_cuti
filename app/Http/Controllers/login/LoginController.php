<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // dd(Auth::user());
        if (Auth::check()) { }
        // dd(Auth::guard('user')->check(), Auth::guard('admin')->check());
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 1])) {
            return redirect()->route('admin.dashboard.index');
        } else if (Auth::guard('lead')->attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 3])) {
            $intendedUrl = session()->pull('url.intended', route('lead.dashboard.index'));
            if (!$intendedUrl) {
                $intendedUrl = route('lead.dashboard.index');
            }
            return redirect()->to($intendedUrl);
        } else if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 2])) {
            $intendedUrl = session()->pull('url.intended', route('user.pengajuan.index'));
            if (!$intendedUrl) {
                $intendedUrl = route('user.pengajuan.index');
            }
            return redirect()->to($intendedUrl);
        }else {
            // Session::flash('loginError', 'Login Failed!');
            return redirect()->back()->with(['gagal' => 'These credentials do not match our records.']);
        }
    }
    public function logout(){
        // dd('masuk');
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('lead')->check()) {
            Auth::guard('lead')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        return redirect('/auth/login');
    }
}
