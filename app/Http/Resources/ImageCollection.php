<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageCollection extends JsonResource
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
            "type" => 'Images',
            "attributes" => [
                "name" => $this->image_name,
                "url" => url('_images/' . $this->image_name),
            ],
//            "relationships" => []
        ];

    }
}
