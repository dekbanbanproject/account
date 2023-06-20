<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use App\Models\Visit_pttype_authen;
use App\Models\Visit_pttype_authen_report;
use App\Models\Patient;
use App\Models\Vn_stat;
use App\Models\Authen_auto;
use App\Models\Visit_pttype_token_authen;
use Stevebauman\Location\Facades\Location;
use Http;
use SoapClient;
use File;
use SplFileObject;
use Arr;
use Storage;
use GuzzleHttp\Client;

class AuthenautoController extends Controller
{

    public function authencode_auto(Request $request)
    {
        $ip = $request->ip();
        // $terminals = Http::get('http://localhost:8189/api/smartcard/terminals')->collect();
        // $cardcid = Http::get('http://localhost:8189/api/smartcard/read')->collect();
        // $cardcidonly = Http::get('http://localhost:8189/api/smartcard/read-card-only')->collect();

        $terminals = Http::get('http://'.$ip.':8189/api/smartcard/terminals')->collect();
        $cardcid = Http::get('http://'.$ip.':8189/api/smartcard/read')->collect();
        $cardcidonly = Http::get('http://'.$ip.':8189/api/smartcard/read-card-only')->collect();

        $output = Arr::sort($terminals);
        $outputcard = Arr::sort($cardcid);
        $outputcardonly = Arr::sort($cardcidonly);
        if ($output == []) {
            // if ($output == "") {
                $smartcard = 'NO_CONNECT';
                $smartcardcon = '';
            } else {
                $smartcard = 'CONNECT';
                foreach ($output as $key => $value) {
                    $terminalname = $value['terminalName'];
                    $cardcids = $value['isPresent'];
                }
                if ($cardcids != 'false') {
                    $smartcardcon = 'NO_CID';
                } else {
                    $smartcardcon = 'CID_OK';
                }
            }

        return view('authen.authencode_auto',[
            'smartcard'            =>   $smartcard,
            'cardcid'            =>  $cardcid,
            'smartcardcon'            =>  $smartcardcon,
            'output'            =>  $output,
        ]);
    }

    public function authencode_auto_detail(Request $request)
    {
        $ip = $request->ip();
        $collection = Http::get('http://'.$ip.':8189/api/smartcard/read?readImageFlag=true')->collect();
        $data['patient'] =  DB::connection('mysql_hos')->select('select cid,hometel from patient limit 10');

        $year = substr(date("Y"),2) +43;
        $mounts = date('m');
        $day = date('d');
        $time = date("His");
        $vn = $year.''.$mounts.''.$day.''.$time;

        $getvn_stat =  DB::connection('mysql_hos')->select('select * from vn_stat limit 2');
        $get_ovst =  DB::connection('mysql_hos')->select('select * from ovst limit 2');
        $get_opdscreen =  DB::connection('mysql_hos')->select('select * from opdscreen limit 2');
        $get_ovst_seq =  DB::connection('mysql_hos')->select('select * from ovst_seq limit 2');
        $get_spclty =  DB::connection('mysql_hos')->select('select * from spclty');
        ///// เจน  hos_guid  จาก Hosxp
        $data_key = DB::connection('mysql_hos')->select('SELECT uuid() as keygen');
        $output4 = Arr::sort($data_key);
        foreach ($output4 as $key => $value) {
            $hos_guid = $value->keygen;
        }
        $datapatient = DB::connection('mysql_hos')->table('patient')->where('cid','=',$collection['pid'])->first();
            if ($datapatient->hometel != null) {
                $cid = $datapatient->hometel;
            } else {
                $cid = '';
            }
            if ($datapatient->hn != null) {
                $hn = $datapatient->hn;
            } else {
                $hn = '';
            }
            if ($datapatient->hcode != null) {
                $hcode = $datapatient->hcode;
            } else {
                $hcode = '';
            }
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "http://localhost:8189/api/smartcard/read?readImageFlag=true",
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $content = $response;
                    $result = json_decode($content, true);

                    // dd($result);

                    @$pid = $result['pid'];
                    @$titleName = $result['titleName'];
                    @$fname = $result['fname'];
                    @$lname = $result['lname'];
                    @$nation = $result['nation'];
                    @$birthDate = $result['birthDate'];
                    @$sex = $result['sex'];
                    @$transDate = $result['transDate'];
                    @$mainInscl = $result['mainInscl'];
                    @$subInscl = $result['subInscl'];
                    @$age = $result['age'];
                    @$checkDate = $result['checkDate'];
                    @$image = $result['image'];
                    @$correlationId = $result['correlationId'];
                    @$startDateTime = $result['startDateTime'];
                    @$claimTypes = $result['claimTypes'];

                    $pid        = @$pid;
                    $fname      = @$fname;
                    $lname      = @$lname;
                    $birthDate      = @$birthDate;
                    $sex      = @$sex;
                    $mainInscl      = @$mainInscl;
                    $subInscl      = @$subInscl;
                    $age      = @$age;
                    $image      = @$image;
                    $correlationId      = @$correlationId;

                    // dd($correlationId);

        return view('authen.authencode_auto_detail',$data,[
            'ip' => $ip,
            'pid'           => $pid,
            'fname'         => $fname,
            'lname'         => $lname,
            'birthDate'     => $birthDate,
            'sex'           => $sex,
            'mainInscl'     => $mainInscl,
            'subInscl'      => $subInscl,
            'age'           => $age,
            'image'         => $image,
            'correlationId' => $correlationId,
        ]);
    }
    public function smartcard_authencode_save(Request $request)
    {
        $ip = $request->ip();
        // $authen = Http::post("http://localhost:8189/api/nhso-service/save-as-draft");
        $cid = $request->person_id;
        $tel = $request->mobile;
        $claimType = $request->claimType;
        $correlationId = $request->correlationId;
        $hn = $request->hn;
        $hcode = $request->hcode;

        $authen = Http::post("http://localhost:8189/api/nhso-service/confirm-save",
        [
            'pid'              =>  $cid,
            'claimType'        =>  $claimType,
            'mobile'           =>  $tel,
            'correlationId'    =>  $correlationId,
            // 'hcode'            =>  $hcode,
            'hn'               =>  $hn
        ]);

        Patient::where('cid', $cid)
            ->update([
                'hometel'         => $tel
            ]);

        return response()->json([
            'status'     => '200'
        ]);
    }

    public function pullauthencode_auto(Request $request)
    {
        // $collection = Http::get('http://localhost:8189/api/smartcard/read?readImageFlag=true')->collect();
        // dd($collection);

        Authen_auto:: truncate();
        $data_hos_ = DB::connection('mysql3')->select('
                SELECT o.vn,ifnull(o.an,"") as an,o.hn,showcid(pt.cid) as cid,pt.hometel
                ,concat(pt.pname,pt.fname," ",pt.lname) as ptname
                ,o.vstdate,ra.ServiceCode,ra.ServiceType,v.hcode,ptt.hipdata_code,ptt.pttype

                from ovst o
                left join vn_stat v on v.vn=o.vn
                left join patient pt on pt.hn=o.hn
                left join pttype ptt on ptt.pttype=o.pttype
                LEFT JOIN rcmdb.authencode ra ON ra.VN = o.vn

                where o.vstdate = CURDATE()
                AND ServiceCode IS NULL AND ptt.hipdata_code="UCS" AND pt.hometel <> ""
                AND pt.hometel <> "ไม่มี" AND pt.hometel <> "-" AND pt.hometel <> "จำไม่ได้" AND pt.hometel <> "."
                AND o.an IS NULL AND ptt.pttype NOT IN("M1","M2","M3","M4","M5","M6","M7")
                
            ');
            // group by o.vn
            // WHERE o.vstdate = CURDATE()
            // where o.vstdate between "' . $startdate . '" and "' . $enddate . '"



            foreach ($data_hos_ as $key => $value) {
                $check = Authen_auto::where('vn', $value->vn)->count();


                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "http://localhost:8189/api/smartcard/read?readImageFlag=true",
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $content = $response;
                    $result = json_decode($content, true);

                    // dd($result);

                    @$pid = $result['pid'];
                    @$correlationId = $result['correlationId'];
                    @$claimTypes = $result['claimTypes'];


                if ($check == 0) {
                    Authen_auto::insert([
                        'vn'             => $value->vn,
                        'hn'             => $value->hn,
                        'cid'            => $value->cid,
                        'vstdate'        => $value->vstdate,
                        'ptname'         => $value->ptname,
                        'ServiceCode'    => $value->ServiceCode,
                        'ServiceType'    => $value->ServiceType,
                        'claimType'      => "PG0060001",
                        'claimTypename'  => "เข้ารับบริการรักษาทั่วไป (OPD/ IPD/ PP)",
                        'correlationId'  =>$result['correlationId'],
                        'mobile'         => $value->hometel,
                        'hcode'          => $value->hcode,
                        'hipdata_code'   => "UCS"
                    ]);

                }
            }
        return view('authen.pullauthencode_auto',[
            'data_hos'            =>   $data_hos_,

        ]);
    }

    public function sendauthencode_auto(Request $request)
    {
        $ip = $request->ip();
        // $authen = Http::post("http://localhost:8189/api/nhso-service/save-as-draft");

        $data_authen_ = DB::connection('mysql')->select('
            SELECT vn,hn,cid,ptname,vstdate,claimType,claimTypename,correlationId,mobile,hcode
            from authen_auto
            where vstdate = CURDATE()
        ');

        foreach ($data_authen_ as $key => $value) {
            $authen = Http::post("http://localhost:8189/api/nhso-service/confirm-save",
            [
                'pid'              =>  $value->cid,
                'claimType'        =>  $value->claimType,
                'mobile'           =>  $value->mobile,
                'correlationId'    =>  $value->correlationId,
                'hn'               =>  $value->hn,
                'hcode'            =>  $value->hcode
            ]);
        }
        // return back();
        return view('authen.sendauthencode_auto',[
            'data_authen_'            =>   $data_authen_,

        ]);
    }

}
