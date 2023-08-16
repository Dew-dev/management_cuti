<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\users\User;
use App\Models\role\Role;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use PDF;

class UsersControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index View and Scope Data
    public function index()
    {
        return view('users.index', [
            "title" => "List User",
            "users" => User::all()->where('is_deleted',null),
            "roles" => Role::all()->where('is_deleted',null)
        ]);
    }

    // Create View Data
    public function create()
    {
        $data['title'] = "Add User";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        $data['roles'] = Role::whereNot('id',1)->get();
        return view('users.create', $data);
    }

    // Store Function to Database
    public function store(Request $request)
    {
        $exec = User::where('email', $request->email)->first();
        $exec_3 = User::where('telpon', $request->phone)->first();

        if($exec || $exec_3){
            return back()->with(['gagal' => 'Email, username atau nomor telepon sudah tersedia!']);
        }else{
            if($request->password == $request->repassword){
                date_default_timezone_set("Asia/Bangkok");
                $datenow = date('Y-m-d H:i:s');
                $sample = User::create([
                    'email' => $request->email,
                    'telpon' => $request->phone,
                    'nip'=>$request->nip,
                    'jns_klmin' => $request->jenis_kelamin,
                    'password' => bcrypt($request->password),
                    'nama' => $request->name,
                    'role_id' => $request->role,
                    'alamat' => $request->address,
                    'created_at' => $datenow
                ]);
                return redirect()->route('admin.dashboard.index')->with(['success' => 'Data berhasil disimpan!']);
            }else{
                return back()->with(['gagal' => 'Password Not Match!']);
            }

        }
    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['id'] = $id;
        $data['title'] = "Detail User";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        $data['users'] = User::where('id', $id)->first();
        $data['roles'] = Role::all();
        return view('users.create', $data);
    }

    // Edit Data View by id
    public function edit($id)
    {
        $data['title'] = "Edit User";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        $data['users'] = User::where('id', $id)->first();
        $data['roles'] = Role::all();
        $data['id'] = $id;
        return view('users.create', $data);
    }

    // Update Function to Database
    public function update(Request $req)
    {
        $exec = User::where('email', $req->email)->first();
        $exec_3 = User::where('telpon', $req->phone)->first();
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');
        // dd($req->id);
        if($req->password && $req->repassword){
            if($req->password == $req->repassword){
                $user_pay = User::where('id', $req->id)->update([
                    'email' => $req->email,
                    'telpon' => $req->phone,
                    'nip' => $req->nip,
                    'password' => bcrypt($req->password),
                    'nama' => $req->name,
                    'role_id' => $req->role,
                    'alamat' => $req->address,
                    'updated_at' => $datenow
                ]);
                if(Auth::guard('admin')->check()){
                    return redirect()->route('admin.users.index')->with(['success' => 'Data berhasil diperbaharui!']);
                }else if(Auth::guard('lead')->check()){
                    return redirect()->route('lead.pengajuan.index')->with(['success' => 'Data berhasil diperbaharui!']);
                }else{
                    return redirect()->route('user.pengajuan.index')->with(['success' => 'Data berhasil diperbaharui!']);
                }
            }else{
                return back()->with(['gagal' => 'Password Not Match!']);
            }
        }else{
            $user_pay = User::where('id', $req->id)->update([
                'email' => $req->email,
                'telpon' => $req->phone,
                'nip' => $req->nip,
                'nama' => $req->name,
                'role_id' => $req->role,
                'alamat' => $req->address,
                'updated_at' => $datenow
            ]);
            if(Auth::guard('admin')->check()){
                return redirect()->route('admin.users.index')->with(['success' => 'Data berhasil diperbaharui!']);
            }else if(Auth::guard('lead')->check()){
                return redirect()->route('lead.pengajuan.index')->with(['success' => 'Data berhasil diperbaharui!']);
            }else{
                return redirect()->route('user.pengajuan.index')->with(['success' => 'Data berhasil diperbaharui!']);
            }
        }
    }

    // Delete Data Function
    public function delete(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $exec = User::where('id', $req->id )->update([
            'updated_at'=> $datenow,
            'is_deleted'=> 1
        ]);

        if ($exec) {
            Session::flash('success', 'Data berhasil dihapus!');
          } else {
            Session::flash('gagal', 'Error Data');
          }
    }

    public function edit_profile($id){
        $data['title'] = "Edit User";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        $data['users'] = User::where('id',Auth::user()->id)->first();
        $data['roles'] = Role::where('id',Auth::user()->role_id)->get();
        $data['id'] = $id;
        return view('users.create', $data);
    }
}
