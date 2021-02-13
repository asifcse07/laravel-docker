<?php

namespace App\Repositories;



use App\Http\Resources\AdCollection;
use App\Models\Ad;
use App\Repositories\Interfaces\AdRepositoryInterface;
use Illuminate\Support\Facades\DB;


class AdRepository implements AdRepositoryInterface
{
    public function getAllAdWithImages($page, $limit){
        $getData = Ad::orderBy('created_at','desc')
            ->get()
        ;
        $returnData = AdCollection::collection($getData);
        return $returnData;
    }

    public function getAllAds()
    {
        // TODO: Implement getAllAds() method.
        $ads = Ad::orderBy('created_at','desc')->paginate(2);
        $data['ads'] = $ads;
        $pagination = $ads->render();
        $data['perPage'] = $ads->perPage();
        $data['pagination'] = $pagination;
        return $data;
    }

    //count
    public function getTotalAds(){
        $totla_ads = Ad::count();
        return $totla_ads;
    }

    //get edit
    public function getAdById($ad_id){
        $getData = Ad::leftJoin('ad_images','ad.id', '=', 'ad_images.ad_id')
            ->where('ad.id', $ad_id)
            ->whereNull('ad_images.deleted_at')
            ->select('ad.*', 'ad_images.id as image_id', 'ad_images.image_name')
            ->get()->toArray()
        ;
//        print_r($getData); die();
        return $getData;
    }
}
