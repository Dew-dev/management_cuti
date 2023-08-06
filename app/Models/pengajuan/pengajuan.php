<?php

namespace App\Models\pengajuan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\users\User;
use App\Models\role\Role;

class pengajuan extends Model
{
    protected $primaryKey = 'id';

    protected $table = "pengajuan";

    protected $guarded = [];

    public $timestamps = false;

    public function user()
      {
        return $this->belongsTo('App\Models\users\User', 'pemohon_id', 'id');
      }

    public function role(){
        $user = User::where('id',$this->user->id)->first();
        // dd(Role::where('id',$user->role_id)->first());
        return Role::where('id',$user->role_id)->first()->nama;
    }
  }
