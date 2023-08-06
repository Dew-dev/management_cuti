<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\order\Order;
use App\Models\product\Product;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\pengajuan\pengajuan;
use App\Models\users\User;
use DateTime;

use Illuminate\Http\Request;

class DashboardControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index View and Scope Data
    public function index()
    {
        // $data['pengajuan'] = pengajuan::get();
        $data['users'] = User::whereNot('role_id',1)->whereNull('deleted_at')->get();
        $data['title'] = "Daftar User";
        return view('dashboard',$data);
    }

}
