<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdImage;
use App\Repositories\Interfaces\AdRepositoryInterface;
use App\Traits\APIResponse;
use Illuminate\Http\Request;

class ApiAdController extends Controller
{
    //
    use APIResponse;
    public function __construct(AdRepositoryInterface $adRepository){
        $this->adRepository = $adRepository;
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
                'ad_images.*' => 'Required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
            ];

            $v = \Validator::make(\Request::all(), $rule);
            if ($v->fails()) {
                return $this->errorResponse($v->errors(), 400, $now);
            }
            $data = $request->all();
            if(empty($data['ad_images'])){
                return $this->errorResponse('Image not found', 400, $now);
            }
            $start_date = $this->_dateFormat($data['ad_start_date']);
            $end_date = $this->_dateFormat($data['ad_end_date']);
            $total_days = $this->_dateDiff($start_date, $end_date);
            $ad_total_price = $total_days * $data['ad_daily_price'];
            $ad_ = new Ad();
            $ad_->ad_title = $data['ad_title'];
            $ad_->ad_start_date = $start_date;
            $ad_->ad_end_date = $end_date;
            $ad_->ad_daily_price = $data['ad_daily_price'];
            $ad_->ad_total_price = $ad_total_price;
            $ad_->save();
            if(!empty($data['ad_images'])){
                foreach ($data['ad_images'] as $image){
//                    print_r($image); //die();
                    $this->_imageUpload($image, $ad_->id);
                }
            }
            \DB::commit();
            return $this->successResponse([],'Ad campaign added successfully',200,$now, []);
        } catch(\Exception $e) {
            $message = "Message : ".$e->getMessage().", File : ".$e->getFile().", Line : ".$e->getLine();
            $error_response = [
                "errorMessage"=> $message,
                "serverReferenceCode"=>$now
            ];
            return $this->errorResponse($e->getMessage(),400,$now);
        }
    }

    //save ad
    public function edit(Request $request){
        $now = date('Y-m-d H:i:s');
        try{
            \DB::beginTransaction();
            $rule = [
                'ad_title' => 'Required',
                'ad_start_date' => 'Required|date',
                'ad_end_date' => 'Required|date',
                'ad_daily_price' => 'Required',
//                'ad_images.*' => 'Required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
            ];

            $v = \Validator::make(\Request::all(), $rule);
            if ($v->fails()) {
                return $this->errorResponse($v->errors(), 400, $now);
            }
            $data = $request->all();
//            if(empty($data['ad_images'])){
//                return $this->errorResponse('Image not found', 400, $now);
//            }
            $start_date = $this->_dateFormat($data['ad_start_date']);
            $end_date = $this->_dateFormat($data['ad_end_date']);
            $total_days = $this->_dateDiff($start_date, $end_date);
            $ad_total_price = $total_days * $data['ad_daily_price'];
            $ad_ = Ad::find($data['ad_id']);
            $ad_->ad_title = $data['ad_title'];
            $ad_->ad_start_date = $start_date;
            $ad_->ad_end_date = $end_date;
            $ad_->ad_daily_price = $data['ad_daily_price'];
            $ad_->ad_total_price = $ad_total_price;
            $ad_->save();
            if(!empty($data['ad_images'])){
                foreach ($data['ad_images'] as $image){
                    $this->_imageUpload($image, $ad_->id);
                }
            }
            \DB::commit();
            return $this->successResponse([],'Ad campaign added successfully',200,$now, []);
        } catch(\Exception $e) {
            $message = "Message : ".$e->getMessage().", File : ".$e->getFile().", Line : ".$e->getLine();
            $error_response = [
                "errorMessage"=> $message,
                "serverReferenceCode"=>$now
            ];
            return $this->errorResponse($e->getMessage(),400,$now);
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

    private function _imageUpload($image, $ad_id){
        $imageName = time() . '_' . time().uniqid(rand()) .'.'. $image->extension();
        $image->move(public_path('_images'), $imageName);
        /* Store $imageName name in DATABASE from HERE */
        $adImage = new AdImage();
        $adImage->ad_id = $ad_id;
        $adImage->image_name = $imageName;
        $adImage->save();

    }


    //ad list
    public function index(Request $request){
        $now = date('Y-m-d H:i:s');
        try{
            $page_data = $request->all();
            $page = isset($page_data['page']) && $page_data['page'] > 0 ? $page_data['page'] : 1;
            $limit = isset($page_data['limit']) && $page_data['limit'] > 0 ? $page_data['limit'] : 10;
            $getData = $this->adRepository->getAllAdWithImages($page, $limit);
            $countTotalItems = $this->adRepository->getTotalAds();
            $total_pages = ($countTotalItems > 0 ? ceil($countTotalItems / $limit) : 1);
            $paginationData = collect([
                'total_pages' => $total_pages > 0 ? strval($total_pages) : 1,
                'current_page' => $page,
                'requested_page' => strval($page > 0 && $page < $total_pages ? ($page + 1) : 1),
                'total_items' => strval($countTotalItems),
                'per_page' => strval($limit)
            ]);
            return $this->successResponse($getData,'Ad Lists',200,$now, $paginationData);
        } catch(\Exception $e) {
            $message = "Message : ".$e->getMessage().", File : ".$e->getFile().", Line : ".$e->getLine();
            $error_response = [
                "errorMessage"=> $message,
                "serverReferenceCode"=>$now
            ];
            return $this->errorResponse($e->getMessage(),400,$now);
        }
    }
}
