<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\Http;
class Authen_auto extends Model
{
    use HasFactory;

    // protected $connection = 'mysql_hos';
    protected $table = 'authen_auto';
    protected $primaryKey = 'authen_auto_id';
    // public $timestamps = false;
    protected $fillable = [
        'vn',
        'cid',
        'hn',
        'ptname',
        'vstdate',
        'ServiceCode',
        'ServiceType'
    ];
}
