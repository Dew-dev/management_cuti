<?php

namespace App\Models\role;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id';

      protected $table = "level_users";

      protected $guarded = [];

      public $timestamps = false;
  }
