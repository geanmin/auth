<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Index as IndexAdmin;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
    /**
     *登录页面
     */
    public function login()
    {
        return view();
    }
    /**
     * 登录验证
     */
    public function checkLogin(Request $request)
    {
        $params = $request->param();
        //var_dump($params);exit();
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
