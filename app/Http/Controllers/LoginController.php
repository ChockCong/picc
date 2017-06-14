<?php
/**
 * Created by PhpStorm.
 * User: PICC
 * Date: 2017/5/22
 * Time: 14:59
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller{
    public function login() {
        return view('login/login');
    }
    public function check(Request $request)
    {
        //获取登陆数据
        $userrow = $request->all();
//        dd($userrow);
        $account = $userrow['account'];
        $password = $userrow['password'];

//        判断账户密码

        if ($i = DB::table('user')
            ->where('Account', '=', $account)
            ->where('Password', '=', $password)
            ->first()

        ) {
            //保存session
            $request->session()->put('user', $i);
            $request->session()->save();
            $d = $i->Dep;
            if ($d == '经营单位') {
                //跳转到JydwController@show
                return redirect()->action('Pz\JydwController@main');
            }
            if ($d == '经营单位经理室') {
                return redirect()->action('Pz\JydwjlsController@main');

            }
            if ($d == '销售部综合岗') {
                return redirect()->action('Pz\XsbController@main');
            }

            if ($d == '车险部经理') {
                return redirect()->action('Pz\CxbjlController@main');
            }
            if ($d == '财务中心主任') {
                return redirect()->action('Pz\CwzxzrController@main');
            }
            if ($d == '分管副总经理') {
                return redirect()->action('Pz\FgfzjlController@main');
            }
            if ($d == '总经理') {
                return redirect()->action('Pz\ZjlController@main');
            }

        } else {
            echo "<script>alert('账户或者密码失败，登陆失败');history.go(-1);</script>";
        }
    }
}