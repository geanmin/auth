<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\Admin as AdminModel;

class Admin extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = Db::name("admin")->order("id","desc")->select();
        $this->assign("list",$list);
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add(Request $request)
    {
      if($request->isPost()){
         $param = $request->param();
          if(!$param){
              $this->error("请输入参数");
          }
          $admin = new AdminModel();
          $code = $admin->add($param);
          if($code == 1){
              $this->success("添加成功!","admin/Admin/index");
          }
              $this->error("添加失败");
       }else{
          $authgroup = Db::name("auth_group")->where("status",1)->select();
          $this->assign("authgroup",$authgroup);
          return view();
      }

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
    public function edit(Request $request)
    {
        if($request->isPost()){

        }else{
            $id = $request->param("id");
            $list = Db::name("admin")->where("id",$id)->find();
            $this->assign("list",$list);
            return view();
        }

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
}
