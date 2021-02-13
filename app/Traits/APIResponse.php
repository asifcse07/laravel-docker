<?php


namespace App\Traits;

trait APIResponse
{
    public function successResponse($data,$message,$statusCode,$serverReferenceCode, $paginationData  = []){
        $response_data = [
                'message'=>$message,
                'serverReferenceCode'=>$serverReferenceCode,
                'data' => $data,
            ];
        if(!empty($paginationData)){
            $response_data['pagination'] = $paginationData;
        }
        return response()->json($response_data, $statusCode,[], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }


    public function errorResponse($message,$statusCode,$serverReferenceCode){
        return response()->json([
            'message'=>$message,
            'serverReferenceCode'=>$serverReferenceCode
        ], $statusCode,[], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }
}
