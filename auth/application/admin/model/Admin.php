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
}
