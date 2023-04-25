<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\DB;

use PDF;
use setasign\Fpdi\Fpdi;
use App\Models\Budget_year;
use Illuminate\Support\Facades\File;
use DataTables;
use Intervention\Image\ImageManagerStatic as Image; 
use App\Mail\DissendeMail;
use Mail; 
use Illuminate\Support\Facades\Storage; 
use Auth;
use Http;
use SoapClient; 
use Arr; 
use GuzzleHttp\Client;

class ManagerController extends Controller
{  
    public function index_manage(Request $request)
    { 
        $startdate = $request->startdate;
        $enddate = $request->enddate; 
        $data = User::all();
         
        return view('manage.index_manage', [
            'data'         => $data,
            'startdate'    => $startdate,
            'enddate'      => $enddate ,
        ]);
    }
    public function manage_dashboard(Request $request)
    { 
        $startdate = $request->startdate;
        $enddate = $request->enddate; 
        $data = User::all();
         
        return view('manage.manage_dashboard', [
            'data'         => $data,
            'startdate'    => $startdate,
            'enddate'      => $enddate ,
        ]);
    }
    public function manage_pullacc(Request $request)
    { 
        $startdate = $request->startdate;
        $enddate = $request->enddate; 
        $data = User::all();
        $acc_debtor = DB::connection('mysql_hos')->select('
                SELECT o.vn,ifnull(o.an,"") as an,o.hn,showcid(pt.cid) as cid
                    ,concat(pt.pname,pt.fname," ",pt.lname) as ptname
                    ,o.vstdate,totime(o.vsttime) as vsttime
                    ,seekname(o.pt_subtype,"pt_subtype") as ptsubtype 
                    ,ptt.pttype_eclaim_id,e.name as pttype_eclaim_name
                    ,o.pttype,ptt.name pttypename
                    ,e.gf_opd as gfmis,e.code as acc_code
                    ,e.ar_opd as account_code,seekname(e.ar_opd,"account") as account_name 
                    ,v.income,v.uc_money,v.discount_money,v.paid_money,v.rcpt_money
                    ,v.rcpno_list as rcpno                
                    ,v.income-v.discount_money-v.rcpt_money as debit
                    ,(select max(max_debt_amount) cc from visit_pttype where vn=o.vn) as max_debt_amount
                from ovst o 
                left join vn_stat v on v.vn=o.vn
                left join patient pt on pt.hn=o.hn
                left join pttype ptt on ptt.pttype=o.pttype
                left join pttype_eclaim e on e.code=ptt.pttype_eclaim_id 
                where o.vstdate between "' . $startdate . '" and "' . $enddate . '" 
                and an IS NULL
                group by o.vn        
            ');
         
        return view('manage.manage_pullacc', [
            'data'         => $data,
            'startdate'    => $startdate,
            'enddate'      => $enddate ,
            'acc_debtor'   => $acc_debtor ,
        ]);
    }
    
}