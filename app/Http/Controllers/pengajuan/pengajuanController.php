<?php

namespace App\Http\Controllers\pengajuan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\pengajuan\pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class pengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['title'] = "Daftar Pengajuan";
        $pengajuan = pengajuan::where('pemohon_id', Auth::user()->id)->where('status',1)->get();
        $year = date('Y');
        $count = 12;
        foreach($pengajuan as $p){
            $tgl = explode(",",$p->tgl_cuti);
            // dd($tgl);
            foreach($tgl as $tgl){
                // $jadiTanggal = date($tgl);
                $tahunCuti= date('Y', strtotime($tgl));
                if($year == $tahunCuti){
                    $count--;
                }
                // dd(date($tgl));
            };
        }
        $data['count'] = $count;
        if (Auth::guard('admin')->check() || Auth::guard('lead')->check()) {
            $data['pengajuan'] = pengajuan::where('deleted_at',null)->get();
        } else {
            $data['pengajuan'] = pengajuan::where('pemohon_id', Auth::user()->id)->where('deleted_at',null)->get();
        }

        // dd(Auth::user()->id);
        return view('pengajuan.index', $data);
    }

    public function countDate($id){
        $data = pengajuan::where('id', $id)->first();
        $diff = date_diff($data->dari,$data->sampai);

        // return

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
        // dd(isWeekend());
        // dd(date('N', strtotime($datenow)) >= 6);
        // isWeekend($datenow);
        $sample = pengajuan::create([
            // 'dari' => $request->from,
            // 'sampai' => $request->to,
            'tgl_cuti' => $request->from,
            'keterangan' => $request->keterangan,
            'status' => 0,
            'tgl_dibuat' => $datenow,
            'pemohon_id' => Auth::user()->id,
            'created_at' => $datenow
        ]);
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.pengajuan.index')->with(['success' => 'Data successfully stored!']);
        } else {
            return redirect()->route('user.pengajuan.index')->with(['success' => 'Data successfully stored!']);
        }
        // }else{
        //     return back()->with(['gagal' => 'Password Not Match!']);
        // }

        // }
    }

    public function approve($id)
    {
        pengajuan::where('id', $id)->update([
            'status' => 1,
            'penyetuju_id' => Auth::user()->id
        ]);
        if (Auth::user('admin')) {
            return redirect()->route('admin.pengajuan.index')->with(['success' => 'Telah Disetujui!']);
        } else {
            return redirect()->route('user.pengajuan.index')->with(['success' => 'Telah Disetujui!']);
        }
    }

    public function disapprove($id)
    {
        pengajuan::where('id', $id)->update([
            'status' => 2,
            'penyetuju_id' => Auth::user()->id
        ]);
        if (Auth::user('admin')) {
            return redirect()->route('admin.pengajuan.index')->with(['gagal' => 'Telah Ditolak!']);
        } else {
            return redirect()->route('user.pengajuan.index')->with(['gagal' => 'Telah Ditolak!']);
        }

    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail Pengajuan";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        $data['users'] = pengajuan::where('id', $id)->first();
        // $data['roles'] = Role::all();
        return view('pengajuan.create', $data);
    }

    // Edit Data View by id
    public function edit($id)
    {
        $data['id'] = $id;
        $data['title'] = "Edit Pengajuan";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        $data['users'] = pengajuan::where('id', $id)->first();
        // $data['roles'] = Role::all();
        return view('pengajuan.create', $data);
    }

    // Update Function to Database
    public function update(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');
        // dd($req->id);
        $user_pay = pengajuan::where('id', $req->id)->update([
            'tgl_cuti' => $req->from,
            // 'sampai' => $req->to,
            'keterangan' => $req->keterangan,
            'updated_at' => $datenow
        ]);

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.pengajuan.index')->with(['success' => 'Data successfully stored!']);
        } else {
            return redirect()->route('user.pengajuan.index')->with(['success' => 'Data successfully stored!']);
        }
        // }
    }

    // Delete Data Function
    public function delete(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $exec = pengajuan::where('id', $req->id)->update([
            // 'updated_at' => $datenow,
            'deleted_at' => $datenow
        ]);

        if ($exec) {
            Session::flash('success', 'Data successfully deleted!');
        } else {
            Session::flash('gagal', 'Error Data');
        }
    }
}
