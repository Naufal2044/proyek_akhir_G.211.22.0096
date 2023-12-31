<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model
{
use HasFactory;
use SoftDeletes;
protected $tables = 'fakultas';
public $timestamps = true;
public $fillable = ['nama_fakultas'];
}
