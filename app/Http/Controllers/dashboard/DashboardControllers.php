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
        $data['total'] = pengajuan::whereNull('deleted_at')->count();
        $data['total_approve'] = pengajuan::whereNull('deleted_at')->where('status', 1)->count();
        $data['total_disapprove'] = pengajuan::whereNull('deleted_at')->where('status', 2)->count();
        $data['title'] = "Dashboard";
        return view('dashboard',$data);
    }

}
