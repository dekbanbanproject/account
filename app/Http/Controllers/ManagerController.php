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
use App\Models\Pttype_acc;

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
                SELECT pt.pttype_acc_code,e.code,e.name as pttype_eclaim_name,pt.pttype_acc_eclaimid,pt.pttype_acc_name
                ,e.ar_opd,e.ar_ipd,pt.pttype_acc_id
                from pttype_acc pt
                left join pttype_eclaim e on e.code=pt.pttype_acc_eclaimid                   
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
    public function manage_setting_edit(Request $request,$id)
    {
        $type = Pttype_acc::find($id);
        // $query= DB::table('data_amphur')
        //   ->join('data_tumbon','data_amphur.ID','=','data_tumbon.AMPHUR_ID')
        //   ->select('data_tumbon.TUMBON_NAME','data_tumbon.ID')
        //   ->where('data_amphur.ID',$id)
        //   ->groupBy('data_tumbon.TUMBON_NAME','data_tumbon.ID')
        //   ->get();
        // $type_ = Pttype::where('pttype','=',$pt)->first();
        // $type = $type_->pttype;
        // $type = Pttype::join('pttype_eclaim','pttype_eclaim.code','=','pttype.pttype_eclaim_id')
        //         ->select('pttype.name','pttype.pttype','pttype_eclaim.code','pttype_eclaim.name','pttype_eclaim.ar_ipd','pttype_eclaim.ar_opd')
        //         ->find($pttype);
                // dd($type);      

        return response()->json([
            'status'     => '200',
            'type'       =>  $type,
        ]);
    }

    public function manage_setting_update(Request $request)
    {
        // $maxid = Pttype_eclaim::max('code'); 
        // $code_max =  $maxid+1;
        // $add = new Pttype_eclaim(); 
        // $add->code = $code_max;
        // $add->ar_opd = $request->input('ar_opd');
        // $add->ar_ipd = $request->input('ar_ipd');
        // $add->name = $request->input('code_name');
        // $add->save();
        $accid = $request->input('acc_id');
        $code = $request->input('ar_opd');         
        // $codei = $request->input('ar_ipd');
        // if ($codeo =='') {
        //     $code = '';
        // } else {
        //     $code = $codei;
        // }        

        $update = pttype_acc::find($accid);
        $update->pttype_acc_eclaimid = $code;
        $update->save();

        return response()->json([
            'status'     => '200', 
        ]);
    }
    public function manage_pull_pttype(Request $request)
    {
        $data_ = Pttype::get();
        Pttype_acc::truncate();
        foreach ($data_ as $key => $value) {
            // $check = Pttype_acc::where('pttype_acc_code','=',$value->pttype)->count();
            // if ($check > 0) {
            //     Pttype_acc::where('pttype_acc_code', $value->pttype)
            //         ->update([
            //             'pttype_acc_code'         => $value->pttype, 
            //             'pttype_acc_name'         => $value->name,
            //             'pttype_acc_eclaimid'     => $value->pttype_eclaim_id, 
            //             'pttype_acc_nhsoadpcode'  => $value->nhso_code
            //         ]);
            // } else {
              

                $date = date('Y-m-d');
                // Pttype_acc::insert([
                //     'pttype_acc_code'         => $value->pttype, 
                //     'pttype_acc_name'         => $value->name,
                //     'pttype_acc_eclaimid'     => $value->pttype_eclaim_id, 
                //     'pttype_acc_nhsoadpcode'  => $value->nhso_code,
                //     'created_at'              => $date 
                // ]);
            // }  

            $add = new Pttype_acc();
            $add->pttype_acc_code =  $value->pttype;
            $add->pttype_acc_name =  $value->name;
            $add->pttype_acc_eclaimid =  $value->pttype_eclaim_id;
            $add->pttype_acc_nhsoadpcode =  $value->nhso_code;
            $add->created_at =  $date;
            $add->save();
        }         
        return response()->json([
            'status'     => '200', 
        ]);
    }
    function add_opd_new(Request $request)
    {     
        if($request->aopd!= null || $request->aopd != ''){    
            $count_check = Pttype_eclaim::where('ar_opd','=',$request->aopd)->count();           
                if($count_check == 0){    
                    $maxid = Pttype_eclaim::max('code'); 
                    $code_max =  $maxid+1;

                    $add = new Pttype_eclaim(); 
                    $add->code = $code_max;
                    $add->ar_opd = $request->aopd;
                    $add->name = $request->code_name;
                    $add->save(); 
                }
                }
                    $query =  DB::connection('mysql_hos')->table('pttype_eclaim')->get();            
                    $output='<option value="">--เลือก--</option>';                
                    foreach ($query as $row){
                        if($request->aopd == $row->ar_opd){
                            $output.= '<option value="'.$row->code.'" selected>'.$row->ar_opd.'</option>';
                        }else{
                            $output.= '<option value="'.$row->code.'">'.$row->ar_opd.'</option>';
                        }   
                }    
            echo $output;        
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