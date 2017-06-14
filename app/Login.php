<?php
/**
 * Created by PhpStorm.
 * User: PICC
 * Date: 2017/5/24
 * Time: 16:07
 */
namespace App;
use Illuminate\Database\Eloquent\Model;

class Login extends Model{

    //指定表名
    protected $table = 'user';
    //自动维护时间
    public $timestamps =true;

    protected function getDateFormat(){
        return time();
    }
    protected function asDateTime($val){
        return $val;
    }
}