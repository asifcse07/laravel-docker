<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdController extends Controller
{
    //
    public function __construct(){

    }

    //home page load
    public function home(){
        return view('ad.home');
    }

    //home page load
    public function index(){
        return view('ad.list');
    }
}
