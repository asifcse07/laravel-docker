<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Traits\APIResponse;
use Illuminate\Http\Request;

class ApiAdController extends Controller
{
    //
    use APIResponse;
    public function __construct(){

    }

    //save ad
    public function add(Request $request){
        $now = date('Y-m-d H:i:s');
        try{
            \DB::beginTransaction();
            $rule = [
                'ad_title' => 'Required',
                'ad_start_date' => 'Required|date',
                'ad_end_date' => 'Required|date',
                'ad_daily_price' => 'Required',
            ];

            $v = \Validator::make(\Request::all(), $rule);
            if ($v->fails()) {
                return $this->errorResponse($v->errors(), 401, $now);
            }
            $data = $request->all();
            $start_date = $this->_dateFormat($data['ad_start_date']);
            $end_date = $this->_dateFormat($data['ad_end_date']);
            $total_days = $this->_dateDiff($start_date, $end_date);
            $ad_total_price = $total_days * $data['ad_daily_price'];
            $partner_category = Ad::updateOrCreate(
                [],
                [
                    'ad_title' => $data['ad_title'],
                    'ad_start_date' => $start_date,
                    'ad_end_date' => $end_date,
                    'ad_daily_price' => $data['ad_daily_price'],
                    'ad_total_price' => $ad_total_price,
                ]
            );
            \DB::commit();
            return $this->successResponse([],'Ad campaign added successfully',200,$now, []);
        } catch(\Exception $e) {
            $message = "Message : ".$e->getMessage().", File : ".$e->getFile().", Line : ".$e->getLine();
            $error_response = [
                "errorMessage"=> $message,
                "serverReferenceCode"=>$now
            ];
            return $this->errorResponse($e->getMessage(),501,$now);
        }
    }

    //get date difference
    private function _dateDiff($start_date, $end_date){
        return date_diff(
            date_create($end_date),
            date_create($start_date)
        )->format('%a');
    }

    //convert date format
    private function _dateFormat($give_date){
        $time = strtotime($give_date);
        $returnFormat = date('Y-m-d',$time);
        return $returnFormat;
    }
}
