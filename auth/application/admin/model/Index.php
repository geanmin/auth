<?php

namespace app\admin\model;

use think\Model;
use think\Db;
class Index extends Model
{
    public function Verification($params)
    {
       $admin = Db::name("tp_admin")->where("name",$params["username"])->find();
       if(!$admin){
           return 1;
       }
        if($admin["password"]!=md5($params["password"])){
           return 2;
        }
       session("id",$admin["id"]);
       session("name",$admin["name"]);
       return 3;
    }
}
