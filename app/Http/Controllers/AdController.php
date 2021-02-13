<?php

namespace App\Http\Controllers;

use App\Models\AdImage;
use App\Repositories\Interfaces\AdRepositoryInterface;
use Illuminate\Http\Request;

class AdController extends Controller
{
    //
    public function __construct(AdRepositoryInterface $adRepository){
        $this->adRepository = $adRepository;
    }

    //home page load
    public function home(){
        return view('ad.home');
    }

    //home page load
    public function index(){
        try {
            $getAds = $this->adRepository->getAllAds();
            return view('ad.list', $getAds);
        } catch(Exception $e) {
            $message = "Message : " . $e->getMessage() . ", File : " . $e->getFile() . ", Line : " . $e->getLine();
//            \App\System::ErrorLogWrite($message);
            return redirect()->back()->with('errormessage', "Something is went wrong!");
        }
    }

    //edit page
    public function show($ad_id){
        try {
            $data['getAds'] = $this->adRepository->getAdById($ad_id);
            return view('ad.edit', $data);
        } catch(Exception $e) {
            $message = "Message : " . $e->getMessage() . ", File : " . $e->getFile() . ", Line : " . $e->getLine();
//            \App\System::ErrorLogWrite($message);
            return redirect()->back()->with('errormessage', "Something is went wrong!");
        }
    }

    //delete image
    public function deleteImage($image_id){
        try {
            $del_image = AdImage::find($image_id);
            $del_image->delete();
            return json_encode(['msg' => 'Image deleted']);
        } catch(Exception $e) {
            $message = "Message : " . $e->getMessage() . ", File : " . $e->getFile() . ", Line : " . $e->getLine();
//            \App\System::ErrorLogWrite($message);
//            return redirect()->back()->with('errormessage', "Something is went wrong!");
            return json_encode(['msg' => 'Something is went wrong!']);
        }
    }
}
