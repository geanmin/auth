<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class AuthGroup extends Model
{
    /**
     * 权限节点树
     */
    public function authGroupTree()
    {
        $list = Db::name("auth_rule")->order("sort","desc")->select();
        $res = $this->ruleAssign($list);
        return $res;
    }
    /**
     * 循环遍历权限以权限高低排列组合
     */
    public function ruleAssign($list,$pid=0)
    {
        static $a = array();
        foreach($list as $key=>$value){
            if($value['pid']==$pid){
                $value['dataid']=$this->getCheckChild($value['id'],$list,True);//传入的id=15 的进入
                $a[]=$value;
                $this->ruleAssign($list,$value['id']);//一次次回调
            }
        }
        return $a;
    }
    /**
     * 权限列表 将其子节点复制其中
     */
    public function getCheckChild($id,$list,$clear = False)
    {
      static $arra = array();
        if($clear){
          $arra = array();
        }
      foreach($list as $key=>$value){
          if($value["id"]==$id){
              $arra[] = $value["id"];//6 7
            $this->getCheckChild($value["pid"],$list,False);//0
          }
      }
        asort($arra);
        $arr = implode("-",$arra);
        return $arr;
    }
}
