<?php
namespace app\admin\controller;

use think\Request;
use app\admin\model\Index as IndexAdmin;
class Index extends Common
{
    public function index()
    {
       return view();
    }
    /**
     * 登录处理
     */
    public function login(Request $request)
    {
        $params = $request->param();
        $captcha = $params["captcha"];
        $yanzhengma = $this->check_verify($captcha);
        if($yanzhengma==2){
            $this->error("验证码错误!");
        }
        $index = new IndexAdmin();
        $code =  $index->Verification($params);
        if($code!=3){
          $this->error("用户名或密码错误!");
        }
        $this->success("登录成功","admin/Index/index");
    }

    function check_verify($code){
        if(!captcha_check($code)){
            return 2;
        };
        return 1;
    }
}
