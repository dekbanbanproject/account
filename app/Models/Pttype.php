<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\Http;
class Pttype extends Model
{
    use HasFactory;

    protected $connection = 'mysql_hos';
    protected $table = 'pttype';
    protected $primaryKey = 'pttype';
    public $timestamps = false;     
}
