<?php

namespace App\Models\pengajuan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan extends Model
{
    protected $primaryKey = 'id';

    protected $table = "pengajuan";

    protected $guarded = [];

    public $timestamps = false;


  }
