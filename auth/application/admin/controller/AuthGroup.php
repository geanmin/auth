<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\AuthGroup as AuthGroupModel;

class AuthGroup extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = Db::name("auth_group")->order("id","desc")->select();
        $this->assign("list",$list);
        $authGroup = new AuthGroupModel();
        //echo "<pre>";
        $res = $authGroup->authGroupTree();

       // var_dump($res);exit();
        //echo "</pre>";
        $this->assign("res",$res);
        return view();
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
    public function edit(Request $request)
    {
        if($request->isPost()){
          $data = $request->param();
          $data["rules"] = implode(",",$data["rules"]);
          $id = Db::name("auth_group")->where("id",$data["id"])->update($data);
            if($id){
                $this->success("修改成功","admin/AuthGroup/index");
            }else{
                $this->error("修改失败");
            }
        }else{
            $authrule = new AuthGroupModel();
            $list = $authrule->authGroupTree();
            $this->assign("list",$list);
            $id = $request->param("id");
            $res = Db::name("auth_group")->where("id",$id)->find();
            $this->assign("res",$res);
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
    /**
     * 新增用户组权限
     */
    public function add(Request $request)
    {
      if($request->isPost()){
         $data = $request->param();
         $data["rules"] = implode(",",$data["rules"]);
          $id = Db::name("auth_group")->insert($data);
          if($id){
              $this->success("添加成功","admin/AuthGroup/index");
          }else{
              $this->error("添加失败");
          }
      }else{
          $authrule = new AuthGroupModel();
          $list = $authrule->authGroupTree();
          $this->assign("list",$list);
          return view();
      }
    }
}
