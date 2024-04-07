<?php

namespace App\Http\Controllers;
use App\Events\PusherBroadcast;
use Illuminate\Http\Request;


class PusherController extends Controller
{
    public function index()
    {
        return view(view:'index');
    }

    public function broadcast(Request $request){
        broadcast(new PusherBroadcast($request->get(key:'message')))->toOthers();
        return view(view:'broadcast',['message'=>$request->get(key:'message')]);
    }

    public function receive(Request $request){
        return view(view:'recieve',['message'=>$request->get(key:'message')]);
    }
    
//      public funtion retrieve(Request $request){
//        return view(view:'retrieve',['message'=>$request->get(key:'message')]);
//   }

}
