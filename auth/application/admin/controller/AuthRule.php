<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\AuthGroup as AuthRuleModel;
class AuthRule extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        if($request->isPost()){

        }else{
            $authRule = new AuthRuleModel();
            $list = $authRule->authGroupTree();
//            echo "<pre>";
//            var_dump($list);
//            echo "</pre>";
//            exit();
            $this->assign("list",$list);
            return view();
        }

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
            //var_dump($data);exit();
            if($data["pid"]==0){
               $data["level"] = 0;
            }else{
                $info = Db::name("auth_rule")->where("id",$data["pid"])->find();
                $data["level"] = $info["level"] + 1;
            }
            $id = Db::name("auth_rule")->where("id",$data["uid"])->data(["name"=>$data["name"],"title"=>$data["title"],"pid"=>$data["pid"],"level"=>$data["level"]])->update();
            if($id){
                $this->success("修改成功","admin/AuthRule/index");
            }else{
                $this->error("修改失败");
            }
        }else{
            $uid = $request->param("id");
            $authrule = new AuthRuleModel();
            $res = $authrule->authGroupTree();
            $this->assign("res",$res);
            $list = Db::name("auth_rule")->where("id",$uid)->find();
            $this->assign("list",$list);
            //var_dump($list);exit();
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
     * 添加新权限
     */
    public function add(Request $request)
    {
        if($request->isPost()){
            $data = $request->param();
            //var_dump($data);exit();
            if($data["pid"]==0){
              $data["level"] = 0;
            }else{
                $info = Db::name("auth_rule")->where("id",$data["pid"])->find();
                $data["level"] = $info["level"] + 1;
            }
            $data["time"] = date("Y-m-d H:i:s",time());
            $id = Db::name("auth_rule")->insert($data);
            if($id){
                $this->success("添加成功","admin/AuthRule/index");
            }else{
                $this->error("添加失败");
            }
        }else{
            $authrule = new AuthRuleModel();
            $list = $authrule->authGroupTree();
            $this->assign("res",$list);
            return view();
        }
    }
    /**
     * 删除
     */
    public function del(Request $request)
    {
        $uid = $request->param("id");
        $id = Db::name("auth_rule")->delete($uid);
        if($id){
            $this->success("删除成功","admin/AuthRule/index");
        }
        else
        {
            $this->error("删除失败");
        }
    }
}
