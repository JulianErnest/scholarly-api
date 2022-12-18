<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
  use HasFactory, SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'test_name',
    'time_limit',
    'test_description',
    'subject_id',
  ];
}
