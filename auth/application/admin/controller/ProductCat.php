<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class ProductCat extends Controller
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
     * 商品分类添加
     */
    public function add(Request $request)
    {
        if($request->isPost()){

        }else{
            return view();
        }
    }
}
