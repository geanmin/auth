<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Auth;

class Common extends Controller
{
    /**
     * 判断权限
     */
    public function _initialize()
    {
        if(!session("id") || !session("name")){
           $this->error("请先登录");
        }
        $auth = new Auth();
        $uid = session("id");
        $request = Request::instance();
        $conrroller = $request->controller();
        $url = $request->action();
        $name  =  $conrroller.'/'.$url;
        $array = array("Index/index","Admin/index","Login/");
        if(session("id")!=1){
          if(!in_array($name,$array)){
             if($auth->check($name,$uid)){
                 $this->error("无权限访问");
             }
          }
        }

    }
}
