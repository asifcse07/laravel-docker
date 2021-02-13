<?php

namespace App\Http\Resources;

use App\Models\AdImage;
use Illuminate\Http\Resources\Json\JsonResource;

class AdCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"=> strval($this->id),
            "type" => 'ad',
            "attributes" => [
                "title" => $this->ad_title,
                "start_date" => $this->ad_start_date,
                "end_date" => $this->ad_end_date,
                "daily_price" => $this->ad_daily_price,
                "total_price" => $this->ad_total_price,
                "images" => ImageCollection::collection(AdImage::where('ad_id', $this->id)->get()),
                "created_at" =>$this->created_at,
            ],
//            "relationships" => []
        ];

    }
}
