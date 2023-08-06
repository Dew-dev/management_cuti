<?php

namespace App\Http\Controllers\pengajuan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\pengajuan\pengajuan;
use Illuminate\Http\Request;

class pengajuanController extends Controller
{
    public function index(){
        $data['title'] = "Daftar Pengajuan";
        // dd($data);
        if(Auth::user('admin')){
            $data['pengajuan'] = pengajuan::get();
        }else{
            $data['pengajuan'] = pengajuan::where('pemohon_id',Auth::user()->id)->get();
        }
        // dd(Auth::user()->id);
        return view('pengajuan.index',$data);
    }

    public function create()
    {

        $data['title'] = "Add Pengajuan";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        // $data['roles'] = Role::whereNot('id',1)->get();
        return view('pengajuan.create', $data);
    }

    // Store Function to Database
    public function store(Request $request)
    {
        // $exec = pengajuan::where('email', $request->email)->first();
        // $exec_3 = pengajuan::where('telpon', $request->phone)->first();

        // if($exec || $exec_3){
        //     return back()->with(['gagal' => 'Your Email, pengajuanname or Phone Already Exist!']);
        // }else{
            // if($request->password == $request->repassword){
                date_default_timezone_set("Asia/Bangkok");
                $datenow = date('Y-m-d H:i:s');
                $sample = pengajuan::create([
                    'dari' => $request->dari,
                    'sampai' => $request->sampai,
                    'tgl_dibuat'=>$datenow,
                    'keterangan' => $request->keterangan,
                    'pemohon_id' => Auth::user()->id,
                    'created_at' => $datenow
                ]);
                if(Auth::user('admin')){
                    return redirect()->route('admin.pengajuan.index')->with(['success' => 'Data successfully stored!']);
                }else{
                    return redirect()->route('user.pengajuan.index')->with(['success' => 'Data successfully stored!']);
                }
            // }else{
            //     return back()->with(['gagal' => 'Password Not Match!']);
            // }

        // }
    }

    public function approve($id){
        pengajuan::where('id',$id)->update([
            'status' => 1,
            'penyetuju_id' => Auth::user()->id
        ]);
    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail User";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        // $data['pengajuan'] = User::where('id', $id)->first();
        $data['roles'] = Role::all();
        return view('pengajuan.create', $data);
    }

    // Edit Data View by id
    public function edit($id)
    {
        $data['title'] = "Edit User";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        // $data['pengajuan'] = User::where('id', $id)->first();
        $data['roles'] = Role::all();
        return view('pengajuan.create', $data);
    }

    // Update Function to Database
    public function update(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');

        if($req->password && $req->repassword){
            if($req->password == $req->repassword){
                $user_pay = User::where('id', $req->id)->update([
                    'email' => $req->email,
                    'telpon' => $req->phone,
                    'password' => bcrypt($req->password),
                    'nama' => $req->name,
                    'role_id' => $req->role,
                    'alamat' => $req->address,
                    'updated_at' => $datenow
                ]);
                return redirect()->route('admin.dashboard.index')->with(['success' => 'Data successfully updated!']);
            }else{
                return back()->with(['gagal' => 'Password Not Match!']);
            }
        }else{
            $user_pay = User::where('id', $req->id)->update([
                'email' => $req->email,
                'telpon' => $req->phone,
                'nama' => $req->name,
                'role_id' => $req->role,
                'alamat' => $req->address,
                'updated_at' => $datenow
            ]);
            return redirect()->route('admin.dashboard.index')->with(['success' => 'Data successfully updated!']);
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
            Session::flash('success', 'Data successfully deleted!');
          } else {
            Session::flash('gagal', 'Error Data');
          }
    }
}
