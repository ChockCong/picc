<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;

class RewardController extends Controller{
    public function rimport(Request $request){
        return view('Reward.importreward');
    }
}

