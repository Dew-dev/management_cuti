<?php

namespace App\Http\Controllers\pengajuan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\pengajuan\pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Response;
class pengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('downloadPDF');
    }

    // View Menu Utama Cuti
    public function index()
    {
        date_default_timezone_set("Asia/Bangkok");
        $data['title'] = "Daftar Pengajuan";
        // Pengecekan Cuti yang di approve
        $pengajuan = pengajuan::where('pemohon_id', Auth::user()->id)->where('status',1)->get();
        $year = date('Y');
        $count = 12;
        // Pehitungan Cuti Per Tahun
        foreach($pengajuan as $p){
            $tgl = explode(",",$p->tgl_cuti);
            foreach($tgl as $tgl){
                $tahunCuti= date('Y', strtotime($tgl));
                if($year == $tahunCuti){
                    $count--;
                }
            };
        }
        $data['count'] = $count;
        if (Auth::guard('admin')->check() || Auth::guard('lead')->check()) {
            $data['pengajuan'] = pengajuan::where('deleted_at',null)->orderBy('tgl_cuti', 'desc')->orderBy('status', 'asc')->get();
        } else {
            $data['pengajuan'] = pengajuan::where('pemohon_id', Auth::user()->id)->where('deleted_at',null)->orderBy('tgl_cuti', 'desc')->orderBy('status', 'asc')->get();
        }

        return view('pengajuan.index', $data);
    }

    public function countDate($id){
        $data = pengajuan::where('id', $id)->first();
        $diff = date_diff($data->dari,$data->sampai);
    }

    // View Cuti
    public function create()
    {
        $data['title'] = "Add Pengajuan";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        return view('pengajuan.create', $data);
    }

    // Simpan Pengajuan Cuti
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');

        // Input ke database pengajuan
        $sample = pengajuan::create([
            'tgl_cuti' => $request->from,
            'keterangan' => $request->keterangan,
            'status' => 0,
            'tgl_dibuat' => $datenow,
            'pemohon_id' => Auth::user()->id,
            'created_at' => $datenow
        ]);
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.pengajuan.index')->with(['success' => 'Data berhasil disimpan!']);
        } else {
            return redirect()->route('user.pengajuan.index')->with(['success' => 'Data berhasil disimpan!']);
        }
    }

    public function approve($id)
    {
        pengajuan::where('id', $id)->update([
            'status' => 1,
            'keterangan_pimpinan' => 'Approve oleh Pimpinan',
            'penyetuju_id' => Auth::user()->id
        ]);
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.pengajuan.index')->with(['success' => 'Approve!']);
        } else {
            return redirect()->route('lead.pengajuan.index')->with(['success' => 'Approve!']);
        }
    }

    public function approval(Request $req)
    {

        $destination='Uploads/Persetujuan/';
        if ($req->hasFile('file_upload')) {
            $file = $req->file('file_upload');
			$filename = time().'_'.$req->file('file_upload')->getClientOriginalName();
			Storage::disk('Uploads')->putFileAs($destination,$file,$filename);
        }else{
            $filename = null;
        }

        $exec = pengajuan::where('id', $req->id)->update([
            'status' => 1,
            'keterangan_pimpinan' => $req->keterangan_pimpinan,
            'penyetuju_id' => Auth::user()->id,
            'lampiran_persetujuan' => $filename
        ]);
        if ($exec) {
            Session::flash('success', 'Disapprove!');
        } else {
            Session::flash('gagal', 'Error Data');
        }
    }

    public function disapprove(Request $req, $id)
    {
        $exec = pengajuan::where('id', $id)->update([
            'status' => 2,
            'keterangan_pimpinan' => $req->keterangan_pimpinan,
            'penyetuju_id' => Auth::user()->id
        ]);

        if ($exec) {
            Session::flash('success', 'Disapprove!');
        } else {
            Session::flash('gagal', 'Error Data');
        }

    }

    // Download File PDF lampiran
    public function downloadPDF($id, $file){
        $file="Uploads/Persetujuan/".$file."";
        return Response::download($file);
    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail Pengajuan";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        $data['users'] = pengajuan::where('id', $id)->first();
        $data['hasil'] = pengajuan::where('id', $id)->first();
        return view('pengajuan.create', $data);
    }

    // Edit Data Pengajuan View by id
    public function edit($id)
    {
        $data['id'] = $id;
        $data['title'] = "Edit Pengajuan";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        $data['users'] = pengajuan::where('id', $id)->first();
        return view('pengajuan.create', $data);
    }

    // Update Pengajuan
    public function update(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');
        $user_pay = pengajuan::where('id', $req->id)->update([
            'tgl_cuti' => $req->from,
            'keterangan' => $req->keterangan,
            'updated_at' => $datenow
        ]);

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.pengajuan.index')->with(['success' => 'Data berhasil diperbaharui!']);
        } else {
            return redirect()->route('user.pengajuan.index')->with(['success' => 'Data berhasil diperbaharui!']);
        }
        // }
    }

    // Delete Data Pengajuan Function
    public function delete(Request $req)
    {
        $datenow = date('Y-m-d H:i:s');
        $exec = pengajuan::where('id', $req->id)->update([
            'deleted_at' => $datenow
        ]);

        if ($exec) {
            Session::flash('success', 'Data berhasil dihapus!');
        } else {
            Session::flash('gagal', 'Error Data');
        }
    }
}
