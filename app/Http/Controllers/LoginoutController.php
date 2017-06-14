<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;

class LoginoutController extends Controller{
    public function loginout(Request $request){
        $request->session()->flush();
        return redirect()->action('LoginController@login');
    }
}

