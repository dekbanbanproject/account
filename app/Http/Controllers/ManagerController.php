<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
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
use App\Models\User;
use App\Models\Pttype;
use App\Models\Pttype_eclaim;

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
    public function manage_setting(Request $request)
    { 
        $startdate = $request->startdate;
        $enddate = $request->enddate; 
        $data = DB::connection('mysql_hos')->select('
                SELECT pt.pttype,pt.name as namept,pt.hipdata_code,e.code,e.name as pttype_eclaim_name,pt.pttype_eclaim_id 
                ,e.ar_opd,e.ar_ipd
                from pttype pt
                left join pttype_eclaim e on e.code=pt.pttype_eclaim_id                   
        ');
        $aropd = Pttype_eclaim::where('pttype_eclaim.ar_opd','<>',NULL)->groupBy('pttype_eclaim.ar_opd')->get();
        $aripd = Pttype_eclaim::where('pttype_eclaim.ar_ipd','<>',NULL)->groupBy('pttype_eclaim.ar_ipd')->get();
        return view('manage.manage_setting', [
            'data'         => $data,
            'startdate'    => $startdate,
            'enddate'      => $enddate ,
            'aropd'        => $aropd ,
            'aripd'        => $aripd ,
        ]);
    }
    public function manage_setting_edit(Request $request,$pttype)
    {
        $type = Pttype::find($pttype);
        // $query= DB::table('data_amphur')
        //   ->join('data_tumbon','data_amphur.ID','=','data_tumbon.AMPHUR_ID')
        //   ->select('data_tumbon.TUMBON_NAME','data_tumbon.ID')
        //   ->where('data_amphur.ID',$id)
        //   ->groupBy('data_tumbon.TUMBON_NAME','data_tumbon.ID')
        //   ->get();

        // $type = Pttype::join('pttype_eclaim','pttype_eclaim.code','=','pttype.pttype_eclaim_id')
        //         ->select('pttype.name','pttype.pttype','pttype_eclaim.code','pttype_eclaim.name','pttype_eclaim.ar_ipd','pttype_eclaim.ar_opd')
        //         ->find($pttype);
                // dd($type);      

        return response()->json([
            'status'     => '200',
            'type'       =>  $type,
        ]);
    }
    // public function manage_setting_update(Request $request)
    // { 
    //     $id = $request->input('editplan_kpi_id');
    //     $maxid = Pttype_eclaim::max('code'); 
    //     $code =  $maxid+1;

    //     $update = Pttype_eclaim::find($id);
    //     $update->plan_strategic_id = $request->input('editplan_strategic_id');
    //     $update->plan_taget_id = $request->input('editplan_taget_id');
    //     $update->plan_kpi_code = $request->input('editplan_kpi_code');
    //     $update->plan_kpi_name = $request->input('editplan_kpi_name'); 
    //     $update->plan_kpi_year = $request->input('editleave_year_id'); 
    //     $update->save();

    //     return response()->json([
    //         'status'     => '200',
    //     ]);
    // }
    
}