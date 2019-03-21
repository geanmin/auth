<?php

namespace app\admin\model;

use think\Model;

use think\Db;

class Admin extends Model
{
    /**
     *  登录密码检查
     *  $data 传递数据
     *  $num 返回的类型
     *  return true
     * */
	public function  LoginCheck($data='')
	{
		$num = 0;
		if($data==''){
			return $num = 1;
		}else{
			//查询
			$info = Admin::getByName($data['name']);
			if($info){
				if($info['password']==md5($data['password'])){
					//必须存进session
					session("id",$info['id']);
					session("name",$info['name']);
					return $num = 4;
				}else{
					return $num = 3;
				}
			}else{
				return $num = 2;
			}
		}
		//dump($data);
	}
	/**
	 * 管理员信息添加
	 */
	public function add($param)
	{
		$user           = new Admin;
		$user->name  = $param["username"];
		$user->password  = md5($param["pass"]);
		$user->save();
		 if($user){
			$id =  $user->id;
			 //同时记录权限表
			 $test["uid"] = $id;
			 $test["group_id"] = $param["authgroup"];
			 $uid = Db::name("auth_group_access")->insert($test);
			 if($uid){
				 return 1;
			 }
			 return 2;
		 }
		 return 2;
	}
}
